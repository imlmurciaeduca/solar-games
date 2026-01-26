<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameResource;
use App\Http\Resources\GamesRelationshipsGenreResource;
use App\Http\Resources\GamesRelationshipsReviewsResource;
use App\Models\Game;
use App\Models\Genre;
use App\Traits\CheckInclude;
use Illuminate\Http\Request;

class GameController extends Controller
{
    use CheckInclude;

    public function index() {
        $filter = request()->input('filter', []);

        $games = Game::
            filter($filter)
            ->when($this->include('genre'), function($query) {
                $query->with('genre');
            })
            ->when($this->include('reviews'), function($query) {
                $query->with('reviews');
            })
            ->paginate();

        $games->appends(request()->query());

        return GameResource::collection($games);
    }

    public function show(Game $game) {
        if($this->include('genre')) {
            $game->load('genre');
        }
        if($this->include('reviews')) {
            $game->load('reviews');
        }
        return new GameResource($game);
    }

    public function store(Request $request) {
        $game = Game::create($request->all());
        return new GameResource($game);
    }

    public function update(Game $game) {
        $game->update(request()->all());
        return $game;
    }

    public function destroy(Game $game) {
        $game->delete();
        return response()->json([
            'message' => 'Eliminado con éxito'
        ]);
    }

    public function gamesRelationshipsGenre(Game $game) {
        return new GamesRelationshipsGenreResource($game);
    }

    public function gamesRelationshipsReviews(Game $game) {
        return new GamesRelationshipsReviewsResource($game);
    }

    public function genreGames(Genre $genre) {
        return GameResource::collection($genre->games);
    }

}
