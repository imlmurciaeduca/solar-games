<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewResource;
use App\Models\Game;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index() {
        return Review::all();
    }

    public function show(Review $review) {
        return $review;
    }

    public function store(Request $request) {
        $review = Review::create($request->all());
        return $review;
    }

    public function update(Review $review) {
        $review->update(request()->all());
        return $review;
    }

    public function destroy(Review $review) {
        $review->delete();
        
        return response()->json([
            'message' => 'Eliminado con éxito'
        ]);

    }

    public function userReviews(User $user) {
        return ReviewResource::collection($user->reviews);
    }

    public function gameReviews(Game $game) {
        return ReviewResource::collection($game->reviews);
    }

    public function createReviewForGame(Game $game, Request $request) {
        $request->merge([
            'game_id' => $game->id,
            'user_id' => Auth::user()->id,
        ]);

        $review = Review::create($request->all());
        return new ReviewResource($review);
    }

    public function selfReviews() {
        return ReviewResource::collection(Auth::user()->reviews);
    }
}
