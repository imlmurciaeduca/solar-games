<?php

namespace App\Http\Resources;

class GamesRelationshipsReviewsResource extends RelationshipManyResource
{
    protected function getResourceName() : string {
        return 'game';
    }
    
    protected function getRelationshipName() : string {
        return 'reviews';
    }
}

