<?php

namespace App\Livewire\Admin\Mahasiswa;

use App\Models\Absensi;
use App\Models\Mahasiswa;
use App\Models\User;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class KelolaMahasiswa extends Component
{
    use LivewireAlert;
    public $data, $nama, $username, $password, $npm, $instansi, $namaUpdate, $usernameUpdate;
    public $passwordUpdate, $npmUpdate, $instansiUpdate, $password_lama, $password_baru, $idMahasiswa;
    public $search = "", $isUpdateModalOpen = false;

    protected $listeners = ['deleteConfirmed' => 'handleConfirm'];

    public function confirmDelete($idMahasiswa)
    {
        $this->idMahasiswa = $idMahasiswa;
        $this->alert('warning', 'Apakah Anda yakin ingin menghapus mahasiswa ini?', [
            'position' => 'center',
            'toast' => false,
            'showConfirmButton' => true,
            'confirmButtonText' => 'Ya, Hapus',
            'showCancelButton' => true,
            'cancelButtonText' => 'Batal',
            'onConfirmed' => 'deleteConfirmed',
            'timer' => null,
        ]);

    }

    public function handleConfirm()
    {
        if ($this->idMahasiswa) {
            $this->deletePermission($this->idMahasiswa);
        }
    }

    public function deletePermission($idMahasiswa)
    {
        $mahasiswa = Mahasiswa::find($idMahasiswa);
        $user = User::where('username', $mahasiswa->username)->first();

        if ($mahasiswa) {
            Absensi::where('username', $user->username)->delete();
            $mahasiswa->delete();
            $user->delete();
            $this->alert('success', 'mahasiswa berhasil dihapus.');
        } else {
            $this->alert('error', 'mahasiswa tidak ditemukan.');
        }
    }

    public function store(){
        $rule = [
            'nama' => 'required|min:3|max:255',
            'username' => 'required|unique:mahasiswas',
            'password' => 'required',
            'npm' => 'required|unique:mahasiswas',
            'instansi' => 'required|min:3|max:255',
        ];

        $data = $this->validate($rule);

        $user = User::create([
            'name' => $this->nama,
            'username' => $this->username,
            'password' => bcrypt($this->password),
        ]);

        $user->assignRole('user');

        Mahasiswa::create([
            'nama' => $user->name,
            'username' => $user->username,
            'npm' => $this->npm,
            'instansi' => $this->instansi,
        ]);

        $this->reset([
            'nama', 'username', 'password', 'npm', 'instansi'
        ]);

        $this->alert('success', 'Berhasil Menambahkan Data');
    }

    public function edit($id){
        $this->isUpdateModalOpen = true;
        $this->idMahasiswa = $id;
        $data = Mahasiswa::find($this->idMahasiswa);
        $user = User::where('username', $data->username)->first();

        $this->namaUpdate = $user->name;
        $this->usernameUpdate = $user->username;
        $this->passwordUpdate = $user->password;
        $this->npmUpdate = $data->npm;
        $this->instansiUpdate = $data->instansi;
    }

    public function update(){
        $rule = [
            'namaUpdate' => 'required|min:3|max:255',
            'usernameUpdate' => 'required|unique:mahasiswas,username,' . $this->idMahasiswa,
            'npmUpdate' => 'required|unique:mahasiswas,npm,' . $this->idMahasiswa,
            'instansiUpdate' => 'required|min:3|max:255',
            'password_lama' => 'nullable',
            'password_baru' => 'nullable',
        ];

        $validate = $this->validate($rule);

        $data = Mahasiswa::find($this->idMahasiswa);
        $user = User::where('username', $data->username)->first();

        if ($validate['password_lama'] !== null && $validate['password_baru'] != null) {
            if ( bcrypt($validate['password_lama']) == $user->password) {
                $user->update([
                    'name' => $validate['namaUpdate'],
                    'username' => $validate['usernameUpdate'],
                    'password' => bcrypt($validate['password_baru']),
                ]);

                $data->update([
                    'nama' => $validate['namaUpdate'],
                    'username' => $validate['usernameUpdate'],
                    'npm' => $validate['npmUpdate'],
                    'instansi' => $validate['instansiUpdate'],
                ]);

                $this->reset([
                    'password_lama', 'password_baru', 'namaUpdate', 'usernameUpdate', 'npmUpdate', 'instansiUpdate'
                ]);

                $this->isUpdateModalOpen = false;

                $this->alert('success', 'Berhasil Merubah Data');

            } else {
                $this->alert('error', 'Password Lama Tidak Sesuai');

                $this->reset([
                    'password_lama', 'password_baru', 'namaUpdate', 'usernameUpdate', 'npmUpdate', 'instansiUpdate'
                ]);

                $this->isUpdateModalOpen = false;
            }
        }else{
            $user->update([
                'name' => $validate['namaUpdate'],
                'username' => $validate['usernameUpdate'],
            ]);

            $data->update([
                'nama' => $validate['namaUpdate'],
                'username' => $validate['usernameUpdate'],
                'npm' => $validate['npmUpdate'],
                'instansi' => $validate['instansiUpdate'],
            ]);

            $this->reset([
                'namaUpdate', 'usernameUpdate', 'npmUpdate', 'instansiUpdate'
            ]);

            $this->isUpdateModalOpen = false;

            $this->alert('success', 'Berhasil Merubah Data');
        }
    }

    public function render()
    {
        $this->data = Mahasiswa::where('nama', 'like', '%' . $this->search . '%')->get();
        return view('livewire.admin.mahasiswa.kelola-mahasiswa')->extends('layouts.app');
    }
}
