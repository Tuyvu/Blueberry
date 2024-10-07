<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;

class CategotyNav extends Component
{
    /**
     * Create a new component instance.
     */
    public $category;
    public function __construct()
    {
        $this->category = Category::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.categoty-nav');
    }
}
