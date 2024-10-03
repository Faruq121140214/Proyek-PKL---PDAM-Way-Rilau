<?php

namespace App\Livewire\Mahasiswa;

use App\Models\Absensi;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RiwayatAbsensi extends Component
{
    public $data;

    public function render()
    {
        $user = Auth::user();
        $this->data = Absensi::where('username', $user->username)
        ->orderBy('id', 'desc')
        ->get()
        ->map(function($absensi) {
            $absensi->tanggal = Carbon::parse($absensi->created_at)->format('d-m-Y');
            $absensi->waktu = Carbon::parse($absensi->created_at)->format('H:i');
            return $absensi;
        });
        return view('livewire.mahasiswa.riwayat-absensi')->extends('layouts.mahasiswa.app');
    }
}
