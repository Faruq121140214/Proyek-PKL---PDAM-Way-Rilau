<?php

namespace App\Livewire\Admin\Absensi;

use App\Models\Absensi;
use Carbon\Carbon;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class KelolaAbsensi extends Component
{
    use LivewireAlert;
    public $data, $namaSearch, $tanggalAwal, $tanggalAkhir, $showButtonClear = false, $isUpdateModalOpen = false, $status, $absensiId;

    public function search(){
        $rules = [
            'namaSearch' => 'required|min:3|max:255',
            'tanggalAwal' => 'required|date',
            'tanggalAkhir' => 'required|date',
        ];

        $this->validate($rules);

        $this->showButtonClear = true;
    }

    public function clearSearch()
    {
        $this->reset([
            'namaSearch', 'tanggalAwal', 'tanggalAkhir'
        ]);

        $this->showButtonClear = false;
    }

    public function edit($id)
    {
        $this->absensiId = $id;
        $mahasiswa = Absensi::where('id', $this->absensiId)->first();
        $this->status = $mahasiswa->status;
        $this->isUpdateModalOpen = true;
    }

    public function update()
    {
        $rules = [
            'status' => 'required|in:hadir,izin,tidak hadir',
        ];

        $this->validate($rules);

        $absen = Absensi::where('id', $this->absensiId)->first();
        $absen->status = $this->status;
        $absen->save();


        $this->alert('success', 'Berhasil Merubah Data.');
        $this->reset([
            'status'
        ]);
        $this->isUpdateModalOpen = false;

    }

    public function render()
    {
        if($this->namaSearch !== null && $this->tanggalAwal !== null && $this->tanggalAkhir !== null){
            $this->data = Absensi::where('nama', 'like', '%' . $this->namaSearch . '%')
                                    ->whereBetween('created_at', [$this->tanggalAwal, $this->tanggalAkhir])
                                    ->get()
                                    ->map(function($absensi) {
                                        $absensi->tanggal = Carbon::parse($absensi->created_at)->format('d-m-Y');
                                        $absensi->waktu = Carbon::parse($absensi->created_at)->format('H:i');
                                        return $absensi;
                                    });

            if ($this->data->isEmpty()) {
                $this->alert('warning', 'Data tidak ditemukan', [
                    'position' => 'center',
                    'toast' => false,
                    'showConfirmButton' => false,
                    'showCancelButton' => false,
                    'timer' => 3000,
                ]);

                $this->reset([
                    'namaSearch', 'tanggalAwal', 'tanggalAkhir'
                ]);

                $this->showButtonClear = false;

                $this->data = Absensi::orderBy('id', 'desc')
                ->get()
                ->map(function($absensi) {
                    $absensi->tanggal = Carbon::parse($absensi->created_at)->format('d-m-Y');
                    $absensi->waktu = Carbon::parse($absensi->created_at)->format('H:i');
                    return $absensi;
                });
            }


        }else{
            $this->data = Absensi::orderBy('id', 'desc')
            ->get()
            ->map(function($absensi) {
                $absensi->tanggal = Carbon::parse($absensi->created_at)->format('d-m-Y');
                $absensi->waktu = Carbon::parse($absensi->created_at)->format('H:i');
                return $absensi;
            });
        }
        return view('livewire.admin.absensi.kelola-absensi')->extends('layouts.app');
    }
}
