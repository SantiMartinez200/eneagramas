<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\EneagramaController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');
    
    
    Route::get('eneagrama/formulario', [EneagramaController::class, 'form'])->name('eneagrama.formulario');
    Route::get('eneagrama/listado',[EneagramaController::class,'list'])->name('eneagrama.listado');
    Route::get('eneagrama/pagina',[EneagramaController::class,'pagina'])->name('eneagrama.pagina');

    Route::get('eneagrama/{alias}/generador-eneagrama',[EneagramaController::class,'generador'])->name('eneagrama.generador-eneagrama');


    Route::resource('eneagrama', EneagramaController::class);
    Route::post('eneagrama.upload',[EneagramaController::class,'upload'])->name('eneagrama.upload');

    //utiliza esto de ejemplo para el posterior con las rutas para cada user, duhhh
    //Route::get('/eneagrama/form/{user}', [EneagramaController::class, 'form'])->name('eneagrama.form');

    Route::get('settings/two-factor', TwoFactor::class) // usuario que completa un eneagrama
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
