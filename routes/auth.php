<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChoferController;
use App\Http\Controllers\GuardaController;
use App\Http\Controllers\PasajeroController;
use App\Http\Controllers\CamionetaController;

Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('login')->group(function () {

    //RUTAS CRUD
    Route::resources([
        'chofer' => ChoferController::class,
        'guarda'=> GuardaController::class,
        'pasajero' => PasajeroController::class
    ]);

    //RUTA CRUD CAMIONETA SEPARADA PORQUE TENIA QUE CAMBIAR EL PARAMETER
    Route::resource('camioneta', CamionetaController::class)->parameters(['camioneta'=> 'camioneta']);

    //RUTA ELIMINAR ARCHIVO CHOFER
    Route::get('eliminar/chofer/{archivo}/{campo}', [ChoferController::class, 'eliminarArchivo'])->name('eliminar.archivo.chofer');

    //RUTA ELIMINAR ARCHIVO GUARDA
    Route::get('eliminar/guarda/{archivo}/{campo}', [GuardaController::class, 'eliminarArchivo'])->name("eliminar.archivo.guarda");

    //SEARCH MODELS
    Route::post('chofer/search', [ChoferController::class, 'search'])->name("chofer.search");
    Route::post('guarda/search', [GuardaController::class, 'search'])->name("guarda.search");
    Route::post('pasajero/search', [CamionetaController::class, 'search'])->name("camioneta.search");
    Route::post('camioneta/search', [PasajeroController::class, 'search'])->name("pasajero.search");

    //DOWNLOAD FILES
    Route::get('/chofer/download/{chofer}', [ChoferController::class, 'downloadFiles'])->name('chofer.downloadFiles');
    Route::get('/guarda/download/{guarda}', [GuardaController::class, 'downloadFiles'])->name('guarda.downloadFiles');


    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
