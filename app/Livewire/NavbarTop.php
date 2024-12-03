<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class NavbarTop extends Component
{
    #[Layout('components.layouts.main')]

    public function logoutUser()
    {
        Auth::logout();
        return redirect()->route('login');
    }


    public function render()
    {
        return view('livewire.navbar-top');
    }
}
