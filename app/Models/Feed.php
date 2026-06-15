<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use SimplePie\SimplePie;

class Feed extends Model
{
    protected $fillable = [
        'user_id',
        'url',
        'title',
        'description',
        'favicon',
        'category_id'
    ];

    public function countNewItems()
    {
        $latest = $this->items()->max('published_at');

        $pie = new SimplePie();
        $pie->set_feed_url($this->url);
        $pie->enable_cache(false);
        $pie->init();

        if ($pie->error()) {
            return 0;
        }

        $newCount = 0;

        foreach ($pie->get_items() as $item) {
            $published = $item->get_date('Y-m-d H:i:s');

            if (!$latest || $published > $latest) {
                $newCount++;
            }
        }

        return $newCount;
    }

    public function items()
    {
        return $this->hasMany(FeedItem::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
