<?php

namespace App\Jobs;

use App\Models\Feed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class FetchAllFeedsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach (Feed::all() as $feed) {
            dispatch(new FetchFeedJob($feed));
        }
    }
}
