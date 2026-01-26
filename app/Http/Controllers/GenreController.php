<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Http\Resources\GenreResource;
use App\Http\Resources\GenresRelationshipGames;
use App\Models\Game;
use App\Models\Genre;
use App\Traits\CheckInclude;
use Illuminate\Http\Request;

class GenreController extends Controller
{

    use CheckInclude;

    public function index() {
        $genres = Genre::
            when($this->include('games'), function($query){
                $query->with('games');
            })
            ->get();

        return GenreResource::collection($genres);
    }

    public function show(Genre $genre) {
        return $genre;
    }

    public function store(GenreRequest $request) {
        $genre = Genre::create($request->validated());
        return $genre;
    }

    public function update(Genre $genre, GenreRequest $request) {
        $genre->update($request->validated());
        return $genre;
    }

    public function destroy(Genre $genre) {
        $genre->delete();
        return response()->json([
            'message' => 'Eliminado con éxito'
        ]);
    }

    public function gameGenre(Game $game) {
        return new GenreResource($game->genre);
    }

    public function genresRelationshipsGames(Genre $genre) {
        return new GenresRelationshipGames($genre);
    }
}
