<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Mahasiswa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AutoAbsensiController extends Controller
{
    public function closeAbsensi()
    {
        $todayAbsensi = Absensi::whereDate('created_at', Carbon::now('Asia/Jakarta')->toDateString())->pluck('nama');

        $mahasiswa = Mahasiswa::whereNotIn('nama', $todayAbsensi)->get();

        foreach ($mahasiswa as $data)
        {
            $absensi = new Absensi;
            $absensi->nama = $data['nama'];
            $absensi->username = $data['username'];
            $absensi->instansi = $data['instansi'];
            $absensi->status = "Tidak Hadir";
        }
    }
}
