<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedItem extends Model
{
    protected $fillable = [
        'feed_id',
        'title',
        'url',
        'description',
        'published_at'
    ];
    //
}
