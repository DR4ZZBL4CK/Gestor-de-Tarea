<?php

use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('tareas.index');
});

Route::resource('tareas', TareaController::class);