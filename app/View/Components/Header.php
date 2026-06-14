<?php

namespace App\View\Components;

use App\Models\Category;
use App\Models\Feed;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public $feeds;
    public $categories;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->feeds = Feed::all();
        $this->categories = Category::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}
