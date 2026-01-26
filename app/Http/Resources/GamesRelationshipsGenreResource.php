<?php

namespace App\Http\Resources;

class GamesRelationshipsGenreResource extends RelationshipOneResource
{
    protected function getResourceName() : string {
        return 'game';
    }
    
    protected function getRelationshipName() : string {
        return 'genre';
    }
}
