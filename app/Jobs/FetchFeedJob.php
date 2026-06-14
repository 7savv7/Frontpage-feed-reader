<?php

namespace App\Jobs;

use App\Models\Feed;
use App\Models\FeedItem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use SimplePie\Simplepie;

class FetchFeedJob implements ShouldQueue
{
    use Queueable;
    public Feed $feed;

    /**
     * Create a new job instance.
     */
    public function __construct(Feed $feed)
    {
        $this->feed = $feed;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $pie = new SimplePie();
        $pie->set_feed_url($this->feed->url);

        // Enable caching
        $pie->set_cache_location(storage_path('app/simplepie'));
        $pie->set_cache_duration(300);
        $pie->enable_cache(true);

        $pie->init();

        if ($pie->error()) {
            $this->feed->update([
                'health_status' => 'error',
            ]);
            return;
        }

        // Update feed metadata
        $this->feed->update([
            'title' => $pie->get_title(),
            'favicon' => $pie->get_favicon(),
            'last_fetch_at' => now(),
            'last_health_status' => 'active',
            'health_status' => 'active',
        ]);

        // Store items
        $items = $pie->get_items(0, 20);

        foreach ($items as $item) {
            FeedItem::updateOrCreate(
                [
                    'feed_id' => $this->feed->id,
                    'url' => $item->get_link(),
                ],
                [
                    'title' => $item->get_title(),
                    'description' => $item->get_description(),
                    'published_at' => $item->get_date('Y-m-d H:i:s'),
                ]
            );
        }
    }
}
