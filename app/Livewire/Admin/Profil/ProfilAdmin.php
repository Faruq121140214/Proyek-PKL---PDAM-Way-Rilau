<?php

namespace App\Livewire\Admin\Profil;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProfilAdmin extends Component
{
    public $profil;
    public function render()
    {
        $this->profil = Auth::user();

        return view('livewire.admin.profil.profil-admin')->extends('layouts.app');
    }
}
