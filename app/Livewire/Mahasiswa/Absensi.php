<?php

namespace App\Livewire\Mahasiswa;

use App\Models\Absensi as ModelsAbsensi;
use App\Models\Mahasiswa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Absensi extends Component
{

    use LivewireAlert;
    public $mahasiswa, $today, $status = "belum absen";

    public function mount()
    {
        $user = Auth::user();
        $this->mahasiswa = Mahasiswa::where('username', $user->username)->first();
        $this->today = Carbon::now()->format('d-m-Y');
        $todayAbsensi = ModelsAbsensi::where('username', $user->username)
        ->whereDate('created_at', Carbon::now()->format('Y-m-d'))
        ->get();

        if ($todayAbsensi->isNotEmpty()) {
            $this->status = $todayAbsensi[0]->status;
        }
    }

    public function absen()
    {
        $this->status = "hadir";
        $absen = new ModelsAbsensi;
        $absen->nama = $this->mahasiswa->nama;
        $absen->username = $this->mahasiswa->username;
        $absen->instansi = $this->mahasiswa->instansi;
        $absen->status = $this->status;
        $absen->save();


        $this->alert('success', 'Absensi Berhasil', [
            'position' => 'center',
            'toast' => false,
            'showConfirmButton' => false,
            'showCancelButton' => false,
            'cancelButtonText' => 'Batal',
        ]);
    }

    public function render()
    {
        $currentTime = Carbon::now()->format('H:i');

        if (Carbon::now()->format('H') < 7) {
            session()->flash('error', 'Presensi hanya dapat dilakukan di jam 07:00 - 07:59 WIB');
            return view('livewire.mahasiswa.absensi')->extends('layouts.mahasiswa.app');
        }

        return view('livewire.mahasiswa.absensi')->extends('layouts.mahasiswa.app');
    }
}
