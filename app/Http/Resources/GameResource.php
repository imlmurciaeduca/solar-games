<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'games',
            'id' => (string) $this->id,
            'attributes' => [
                'title' => $this->title,
                'synopsis' => $this->synopsis,
                'developer' => $this->developer,
                'publisher' => $this->publisher,
                'releaseYear' => (string) $this->release_year,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at,
            ],
            'links' => [
                'self' => route('games.show', ['game' => $this->id])
            ],
            'relationships' => [
                'genre' => new GamesRelationshipsGenreResource($this),
                'reviews' => new GamesRelationshipsReviewsResource($this),
            ],
            'included' => collect()
                ->when($this->relationLoaded('genre'), fn($collection) => 
                    $collection->push(new GenreResource($this->genre))
                )
                ->when($this->relationLoaded('reviews'), fn($collection) => 
                    $collection->merge(ReviewResource::collection($this->reviews))
                )
                ->all()
        ];
    }

    public function with(Request $request)
    {
        return [
            'included' => [
                'loquesea' => 'loquesea'
            ]
        ];
    }
}
