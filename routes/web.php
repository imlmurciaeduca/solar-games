<?php

use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "Ya no me gustan las vistas, mi nuevo mejor amigo es la API";
});

Route::get('/games', [GameController::class, 'index']);