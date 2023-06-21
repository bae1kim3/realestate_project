<?php

namespace App\View\Components;

use Illuminate\View\Component;

class JetInput extends Component
{
    /**
     * The input's type.
     *
     * @var string
     */
    public $type;

    /**
     * The input's name.
     *
     * @var string
     */
    public $name;

    /**
     * The input's value.
     *
     * @var mixed
     */
    public $value;

    /**
     * Create a new component instance.
     *
     * @param  string  $type
     * @param  string  $name
     * @param  mixed  $value
     * @return void
     */
    public function __construct($type, $name, $value = null)
    {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.jet-input');
    }
}
