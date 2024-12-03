<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Login extends Component
{
    #[Layout('components.layouts.auth')]

    public $email, $password;

    protected function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
    }

    public function loginUser()
    {
        $this->validate();
        // login logic
        $limitKey = $this->email . '|' . request()->ip();

        if (RateLimiter::tooManyAttempts($limitKey, 3)) {
            $this->addError(
                'email',
                __('auth.throttle', ['seconds' => RateLimiter::availableIn($limitKey)])
            );
            return null;
        }

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            RateLimiter::hit($limitKey);
            $this->addError('email', __('auth.failed'));
            return null;
        }

        return redirect()->route('dashboard');
    }

    // logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('/');
    }

    public function render()
    {
        return view('livewire.login');
        // return view('livewire.login')->layout('components.layouts.auth')->section('content');
    }
}
