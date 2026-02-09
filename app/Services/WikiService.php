<?php

namespace App\Services;

use App\DTOs\GameDTO;
use Illuminate\Support\Facades\Http;

class WikiService {

    private $baseUrl = 'https://en.wikipedia.org/api/rest_v1/page/summary/';

    public function getDataFromWikipedia(string $gameTitle) {
        $gameTitle = str_replace(' ', '_', $gameTitle);

        $response = Http::withUserAgent('SolarGames/1.0')
            ->get($this->baseUrl . $gameTitle);

        if ($response->failed()) {
            return null;
        }

        $data = $response->json();

        return new GameDTO (
            $data['thumbnail']['source'] ?? null,
            $data['extract'] ?? null
        );
    }

}