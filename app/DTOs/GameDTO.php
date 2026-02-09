<?php

namespace App\DTOs;

class GameDTO
{
    private string $cover;
    private string $description;

    public function __construct(string $cover, string $description) {
        $this->cover = $cover;
        $this->description = $description;
    }

    public function toArray() {
        return [
            'cover' => $this->cover,
            'description' => $this->description 
        ];
    }
}
