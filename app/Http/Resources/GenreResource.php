<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GenreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'genres',
            'id' => (string) $this->id,
            'attributes' => [
                'name' => $this->name,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at,
            ],
            'links' => [
                'self' => route('genres.show', ['genre' => $this->id])
            ],
            'relationships' => [
                'games' => new GenresRelationshipGames($this)
            ],
            'include' => collect()
                ->when($this->relationLoaded('games'), fn($collection) =>
                    $collection->merge(GameResource::collection($this->games))
                )
                ->all()
        ];
    }
}
