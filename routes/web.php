<?php

use App\Http\Controllers\LogoutController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Warga\Dashboard as WargaDashboard;
use App\Livewire\Warga\Laporan\Create as WargaLaporanCreate;
use App\Livewire\Warga\Laporan\Index as WargaLaporanIndex;
use App\Livewire\Warga\Laporan\Show as WargaLaporanShow;
use App\Livewire\Warga\Profile as WargaProfile;
use App\Livewire\Warga\Laporan\Edit as WargaLaporanEdit;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Laporan\Index as AdminLaporanIndex;
use App\Livewire\Admin\Laporan\Show as AdminLaporanShow;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::post('/logout', LogoutController::class)->middleware('auth')->name('logout');

Route::middleware(['auth', 'role:warga'])->prefix('warga')->name('warga.')->group(function (): void {
    Route::get('/dashboard', WargaDashboard::class)->name('dashboard');
    Route::get('/laporan', WargaLaporanIndex::class)->name('laporan.index');
    Route::get('/laporan/buat', WargaLaporanCreate::class)->name('laporan.create');
    Route::get('/laporan/{laporan}', WargaLaporanShow::class)->name('laporan.show');
    Route::get('/profile', WargaProfile::class)->name('profile');

    // Di dalam grup Route::middleware(['auth', 'role:warga'])->prefix('warga')->name('warga.')->group(...)
    Route::get('/laporan/{laporan}/edit', WargaLaporanEdit::class)->name('laporan.edit');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/laporan', AdminLaporanIndex::class)->name('laporan.index');
    Route::get('/laporan/{laporan}', AdminLaporanShow::class)->name('laporan.show');
});
