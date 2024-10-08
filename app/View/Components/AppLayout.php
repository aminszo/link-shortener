<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{

    /**
     * Create the component instance.
     */
    public function __construct(
        // $theme variable to set the ui theme in html tag. default value is "theme-dark"
        public string $theme = "theme-dark",
    ) {}

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
