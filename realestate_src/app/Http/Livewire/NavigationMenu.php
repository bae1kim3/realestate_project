<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NavigationMenu extends Component
{
    public bool $darkMode = false;

    public function toggleDarkMode()
    {
        $this->darkMode = !$this->darkMode;

        if ($this->darkMode) {
            session(['dark_mode' => true]);
        } else {
            session()->forget('dark_mode');
        }
    }

    public function render()
    {
        return view('livewire.navigation-menu');
    }
}
