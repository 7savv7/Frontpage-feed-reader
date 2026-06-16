<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedItem extends Model
{
    protected $fillable = [
        'feed_id',
        'seen',
        'bookmarked',
        'title',
        'url',
        'description',
        'published_at'
    ];

    public function feed()
    {
        return $this->belongsTo(Feed::class);
    }
}
