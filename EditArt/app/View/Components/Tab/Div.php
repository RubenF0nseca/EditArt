<?php

namespace App\View\Components\Tab;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Div extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $class,
        public string $id,
        public string $orientation
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tab.div');
    }
}
