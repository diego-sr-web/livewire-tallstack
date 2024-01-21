<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class Login extends Component
{
    public string $email;
    public string $password;
    public bool $remember = false;

    protected array $rules = [
        'email' => 'required|email',
        'password' => 'required|min:3'
    ];

    protected array $messages = [
        'email.required' => 'Email obrigatório',
        'email.email' => 'Email inválido',
        'password.required' => 'Senha obrigatória',
        'password.min' => 'A senha deve conter a partir de 3 caracteres',
    ];

    public function render()
    {
        return view('livewire.users.login')
            ->layout('layouts.guest');
    }

    public function updated($fieldName)
    {
        $this->validateOnly($fieldName);
    }

    public function login()
    {
        $this->validate();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $redirect = RouteServiceProvider::PAINEL;

        if (in_array(user()->profile->role->id,[1, 2])) {
            $redirect = RouteServiceProvider::ADMIN;
        }

        return redirect()->intended($redirect);
    }
}
