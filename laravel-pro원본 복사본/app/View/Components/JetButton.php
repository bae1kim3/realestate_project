<?php

namespace App\View\Components;

use Illuminate\View\Component;

class JetButton extends Component
{
    /**
     * The button's label.
     *
     * @var string
     */
    public $label;

    /**
     * Create a new component instance.
     *
     * @param  string  $label
     * @return void
     */
    public function __construct($label)
    {
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.jet-button');
    }
}
