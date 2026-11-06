<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteWebController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prueba/pacientes', [PacienteWebController::class, 'create'])
    ->name('pacientes.create');

Route::post('/prueba/pacientes', [PacienteWebController::class, 'store'])
    ->name('pacientes.store');