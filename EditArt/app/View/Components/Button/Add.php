<?php

namespace App\View\Components\Button;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Add extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $link,
        public string $icon
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button.add');
    }
}
