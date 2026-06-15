<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArticleHeader extends Component
{
    public int $total;
    /**
     * Create a new component instance.
     */
    public function __construct(int $total)
    {
        $this->total = $total;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.article-header');
    }
}
