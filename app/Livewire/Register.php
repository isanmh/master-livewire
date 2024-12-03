<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Register extends Component
{
    #[Layout('components.layouts.auth')]

    public $name, $email, $password, $password_confirmation;

    public function render()
    {
        return view('livewire.register');
    }

    // protected function rules()
    // {
    //     return [
    //         'name' => 'required|min:6',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|min:6|confirmed',
    //     ];
    // }

    // // custom message
    // protected $messages = [
    //     'name.required' => 'Nama tidak boleh kosong',
    // ];

    public function registerUser()
    {
        $this->validate(
            [
                'name' => 'required|min:6',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6|confirmed',
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
            ]
        );

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            // 'password' => Hash::make($this->password),
            'password' => bcrypt($this->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
