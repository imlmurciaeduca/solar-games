<?php

namespace App\Http\Resources;

class GenresRelationshipGames extends RelationshipManyResource
{
    protected function getResourceName() : string {
        return 'genre';
    }
    
    protected function getRelationshipName() : string {
        return 'games';
    }
}
