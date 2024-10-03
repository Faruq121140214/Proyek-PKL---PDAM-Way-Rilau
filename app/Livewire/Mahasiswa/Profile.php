<?php

namespace App\Livewire\Mahasiswa;

use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Profile extends Component
{
    public $mahasiswa;
    public function render()
    {
        $user = Auth::user();
        $this->mahasiswa = Mahasiswa::where('username', $user->username)->first();
        return view('livewire.mahasiswa.profile')->extends('layouts.mahasiswa.app');
    }
}
