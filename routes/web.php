<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\PrintRiwayatAbsensi;
use App\Livewire\Admin\Absensi\KelolaAbsensi;
use App\Livewire\Admin\Dashboard as DashboardAdmin;
use App\Livewire\Admin\Mahasiswa\KelolaMahasiswa;
use App\Livewire\Admin\Profil\ProfilAdmin;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Passwords\Email;
use App\Livewire\Mahasiswa\Absensi;
use App\Livewire\Mahasiswa\Dashboard as DashboardMahasiswa;
use App\Livewire\Mahasiswa\Profile;
use App\Livewire\Mahasiswa\RiwayatAbsensi;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/', Login::class)
    ->name('login');
});

// Route::get('password/reset', Email::class)
//     ->name('password.request');


Route::middleware('auth')->group(function () {

    Route::middleware(['role:admin'])->name('admin.')->prefix('admin')->group(function () {
        Route::get('dashboard', DashboardAdmin::class)
        ->name('dashboard');

        Route::get('profile', ProfilAdmin::class)
        ->name('profile');

        Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
            Route::get('kelola-mahasiswa', KelolaMahasiswa::class)
                ->name('kelola-mahasiswa');
        });

        Route::prefix('absensi')->name('absensi.')->group(function () {
            Route::get('kelola-absensi', KelolaAbsensi::class)
                ->name('kelola-absensi');
        });
    });

    Route::middleware(['role:user'])->name('mahasiswa.')->prefix('mahasiswa')->group(function () {
        Route::get('dashboard', DashboardMahasiswa::class)
        ->name('dashboard');

        Route::get('profile', Profile::class)
        ->name('profile');

        Route::get('absensi', Absensi::class)
        ->name('absensi');

        Route::get('riwayat-absensi', RiwayatAbsensi::class)
        ->name('riwayat-absensi');

        Route::get('riwayat-absensi/print', [PrintRiwayatAbsensi::class, 'print'])
        ->name('riwayat-absensi.print');
    });

    Route::get('logout', LogoutController::class)
        ->name('logout');
});
