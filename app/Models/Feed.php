<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function items()
    {
        return $this->hasMany(FeedItem::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
