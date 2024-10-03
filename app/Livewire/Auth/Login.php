<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    /** @var string */
    public $username = '';

    /** @var string */
    public $password = '';

    /** @var bool */
    public $remember = false;

    protected $rules = [
        'username' => ['required'],
        'password' => ['required'],
    ];

    public function authenticate()
    {
        $this->validate();

        if (!Auth::attempt(['username' => $this->username, 'password' => $this->password], $this->remember)) {
            $this->addError('username', trans('auth.failed'));

            return;
        }

        $user = Auth::user();
        // dd($user);

        if ($user->hasRole('admin')) {
            return redirect()->intended(route('admin.dashboard'));
        }

        if ($user->hasRole('user')) {
            return redirect()->intended(route('mahasiswa.dashboard'));
        }

    }

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.auth');
    }
}
