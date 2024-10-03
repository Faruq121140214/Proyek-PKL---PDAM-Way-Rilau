<?php

namespace App\Console\Commands;

use App\Models\Absensi;
use App\Models\Mahasiswa;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TestCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $todayAbsensi = Absensi::whereDate('created_at', Carbon::now('Asia/Jakarta')->toDateString())->pluck('nama');

        $mahasiswa = Mahasiswa::whereNotIn('nama', $todayAbsensi)->get();

        foreach ($mahasiswa as $data) {
            $absensi = new Absensi;
            $absensi->nama = $data->nama;
            $absensi->username = $data->username;
            $absensi->instansi = $data->instansi;
            $absensi->status = "Tidak Hadir";
            $absensi->save();
        }

        $this->info('Absensi closure process completed successfully.');
    }
}
