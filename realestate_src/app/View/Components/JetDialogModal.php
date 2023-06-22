<?php

namespace App\View\Components;

use Illuminate\View\Component;

class JetDialogModal extends Component
{
    /**
     * The modal's title.
     *
     * @var string
     */
    public $title;

    /**
     * The modal's content.
     *
     * @var string
     */
    public $content;

    /**
     * Create a new component instance.
     *
     * @param  string  $title
     * @param  string  $content
     * @return void
     */
    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.jet-dialog-modal');
    }
}
