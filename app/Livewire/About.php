<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class About extends Component
{
    #[Title('Biodata Page')]

    public $title = 'Biodata Page';
    public $name = 'Ihsan Miftahul Huda';
    public $address = 'Bandung';
    public $job = 'Fullstack Developer';
    public $image = 'https://avatars.githubusercontent.com/u/47204300?v=4';

    // public function mount($name)
    // {
    //     $this->name = $name;
    // }

    public function render()
    {
        return view('livewire.about');
    }
}
