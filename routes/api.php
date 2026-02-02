<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Models\Game;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/', function () {
    return "Laravel ha vuelto, ¡y en forma de API!";
});


Route::apiResource('genres', GenreController::class)->only(['index', 'show']);
Route::apiResource('games', GameController::class)->only(['index', 'show']);
Route::apiResource('reviews', ReviewController::class)->only(['index', 'show']);

Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('genres', GenreController::class)->except(['index', 'show']);

    Route::apiResource('games', GameController::class)->except(['index', 'show', 'create']);

    Route::post('games', [GameController::class, 'store']);

    Route::apiResource('reviews', ReviewController::class)->except(['index', 'show', 'destroy']);

    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])
        ->can('delete', 'review');

    Route::post('/genres/{genre}/games', [GameController::class, 'createGameWithGenre']);

    Route::post('/games/{game}/reviews', [ReviewController::class, 'createReviewForGame']);

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/users/self/reviews', [ReviewController::class, 'selfReviews']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::get('/users/{user}/reviews', [ReviewController::class, 'userReviews']);

Route::get('/games/{game}/genre', [GenreController::class, 'gameGenre'])
    ->name('games.genre');
Route::get('/games/{game}/relationships/genre', [GameController::class, 'gamesRelationshipsGenre'])
    ->name('games.relationships.genre');

Route::get('/genres/{genre}/games', [GameController::class, 'genreGames'])
    ->name('genres.games');
Route::get('/genres/{genre}/relationships/games', [GenreController::class, 'genresRelationshipsGames'])
    ->name('genres.relationships.games');

Route::get('/games/{game}/reviews', [ReviewController::class, 'gameReviews'])
    ->name('games.reviews');
Route::get('/games/{game}/relationships/reviews', [GameController::class, 'gamesRelationshipsReviews'])
    ->name('games.relationships.reviews');


Route::get('/users', [UserController::class, 'index']);