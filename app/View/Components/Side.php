<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Feed;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Side extends Component
{
    public $feeds;
    public $categories;
    public $total;
    /**
     * Create a new component instance.
     */
    public function __construct(int $total)
    {
        $this->feeds = Feed::withCount('items')->get();
        $this->categories = Category::withCount([
            'feeds as items_count' => function ($q) {
                $q->join('feed_items', 'feeds.id', '=', 'feed_items.feed_id');
            }
        ])->get();
        $this->total = $total;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.side');
    }
}
