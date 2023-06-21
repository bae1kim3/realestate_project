<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navlink extends Component
{
    public $href;
    public $active;

    /**
     * Create a new component instance.
     *
     * @param  string  $href
     * @param  bool  $active
     * @return void
     */
    public function __construct($href, $active = false)
    {
        $this->href = $href;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navlink');
    }
}
