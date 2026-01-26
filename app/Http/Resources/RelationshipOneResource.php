<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class RelationshipOneResource extends JsonResource
{
    abstract protected function getResourceName(): string;
    abstract protected function getRelationshipName(): string;
    
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [
            'links' => [
                'self' => route($this->getTable() . '.relationships.' . $this->getRelationshipName(), [$this->getResourceName() => $this->id]),
                'related' => route($this->getTable() . '.' . $this->getRelationshipName(), [$this->getResourceName() => $this->id])
            ],
            'data' => [
                [
                    'type' => $this->{$this->getRelationshipName()}->getTable(),
                    'id' => (string) $this->{$this->getRelationshipName()}->id
                ]
            ]
        ];
    }
}
