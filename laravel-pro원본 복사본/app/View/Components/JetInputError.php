<?php

namespace App\View\Components;

use Illuminate\View\Component;

class JetInputError extends Component
{
    /**
     * The input's name.
     *
     * @var string
     */
    public $name;

    /**
     * Create a new component instance.
     *
     * @param  string  $name
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.jet-input-error');
    }
}
