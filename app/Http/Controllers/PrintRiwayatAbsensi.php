<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Mahasiswa;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrintRiwayatAbsensi extends Controller
{
    public function print()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('username', $user->username)->first();
        $data = Absensi::where('username', $user->username)
            ->orderBy('id', 'desc')
            ->get()
            ->map(function($absensi) {
                $absensi->tanggal = Carbon::parse($absensi->created_at)->format('d-m-Y');
                $absensi->waktu = Carbon::parse($absensi->created_at)->format('H:i');
                return $absensi;
            });

        $pdf = PDF::loadView('pdf.riwayat-absensi', compact('data', 'mahasiswa'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream('riwayat-absensi.pdf');
    }
}
