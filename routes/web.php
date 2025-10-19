<?php

use App\Http\Controllers\PrincipalController;
use App\Livewire\GenerosManager;
use App\Livewire\LibrosCatalogo;
use App\Livewire\LibrosManager;
use App\Livewire\PrestamosHistorial;
use App\Livewire\PrestamosManager;
use App\Livewire\SociosManager;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('catalogo', LibrosCatalogo::class)->name('libros.catalogo');

Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('dashboard', [PrincipalController::class, 'caducados'])->name('dashboard');
    Route::get('generos', GenerosManager::class)->name('generos.index');
    Route::get('libros', LibrosManager::class)->name('libros.index');
    Route::get('socios', SociosManager::class)->name('socios.index');
    Route::get('prestamos', PrestamosManager::class)->name('prestamos.index');
    Route::get('historial', PrestamosHistorial::class)->name('prestamos.historial');

});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
