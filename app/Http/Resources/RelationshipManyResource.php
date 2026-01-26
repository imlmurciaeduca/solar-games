<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class RelationshipManyResource extends JsonResource
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
        $table = $this->getTable();
        $resourceName = $this->getResourceName();
        $relationName = $this->getRelationshipName();

        return [
            'links' => [
                'self' => route($table . '.relationships.' . $relationName, [$resourceName => $this->id]),
                'related' => route($table . '.' . $relationName, [$resourceName => $this->id])
            ],
            'data' => $this->{$this->getRelationshipName()}->map(fn($item)=>[
                'type' => $item->getTable(),
                'id' => (string) $item->id
            ])
        ];
    }
}
