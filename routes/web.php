<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Http\Controllers\EneagramaController;
use App\Http\Controllers\EneagramaPreguntaController;
use App\Http\Controllers\EneagramaUsuarioFraseController;
use App\Http\Controllers\EneagramaUsuarioPreguntaController;
use App\Http\Controllers\EneagramaUsuarioVerboController;

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
    
    
    Route::get('eneagrama/formulario', [EneagramaController::class, 'formSimple'])->name('eneagrama.formulario');

    Route::get('/eneagramas/{seccion?}', [EneagramaController::class, 'form'])
        ->where('seccion', 'preguntas|frases|verbos')
        ->name('eneagramas.form');

    Route::get('eneagrama/listado',[EneagramaController::class,'list'])->name('eneagrama.listado');

    Route::get('eneagrama/preguntas/reload', [EneagramaController::class,'listPreguntas'])->name('eneagrama.listado.relaod');
    Route::get('eneagrama/frases/reload', [EneagramaController::class,'listFrases'])->name('eneagrama.listado.relaod');
    Route::get('eneagrama/verbos/reload', [EneagramaController::class,'listVerbos'])->name('eneagrama.listado.relaod');

    Route::get('eneagrama/crear',[EneagramaController::class,'crearDesdeBase'])->name('eneagrama.crear');
    Route::get('eneagrama/pagina',[EneagramaController::class,'pagina'])->name('eneagrama.pagina');
    Route::get('eneagrama/{alias}/generador-eneagrama',[EneagramaController::class,'generador'])->name('eneagrama.generador-eneagrama');
    //Route::resource('eneagrama', EneagramaController::class);
    Route::post('eneagrama.upload',[EneagramaController::class,'upload'])->name('eneagrama.upload');



    Route::get('pregunta/{pregunta}/editar', [EneagramaUsuarioPreguntaController::class,'edit'])->name('pregunta.editar');
    Route::post('pregunta/crear', [EneagramaUsuarioPreguntaController::class,'store'])->name('pregunta.crear');

    Route::get('pregunta/{frase}/editar', [EneagramaUsuarioFraseController::class,'edit'])->name('frase.editar');
    Route::post('frase/crear', [EneagramaUsuarioFraseController::class,'store'])->name('frase.crear');

    Route::get('pregunta/{verbo}/editar', [EneagramaUsuarioVerboController::class,'edit'])->name('verbo.editar');
    Route::post('verbo/crear', [EneagramaUsuarioVerboController::class,'store'])->name('verbo.crear');


    Route::get('/tu-pagina', [EneagramaController::class, 'pagina'])->name('eneagrama.pagina');
    Route::get('tu-pagina/visualizar', [EneagramaController::class, 'preview'])->name('tu.pagina.preview');
    Route::post('tu-pagina/actualizar', [EneagramaController::class, 'update'])->name('tu.pagina.update');
    //utiliza esto de ejemplo para el posterior con las rutas para cada user, duhhh
    //Route::get('/eneagrama/{user}/generador-eneagrama', [EneagramaController::class, 'form'])->name('eneagrama.form');

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
