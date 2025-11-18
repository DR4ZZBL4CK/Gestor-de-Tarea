<?php

use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('tareas.index');
});

Route::get('tareas/estado', [TareaController::class, 'porEstado'])->name('tareas.porEstado');

Route::resource('tareas', TareaController::class);
