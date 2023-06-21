<?php

namespace App\View\Components;

use Illuminate\View\Component;

class JetLabel extends Component
{
    /**
     * The label's for attribute.
     *
     * @var string
     */
    public $for;

    /**
     * The label's value.
     *
     * @var string
     */
    public $value;

    /**
     * Create a new component instance.
     *
     * @param  string  $for
     * @param  string  $value
     * @return void
     */
    public function __construct($for, $value)
    {
        $this->for = $for;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.jet-label');
    }
}
