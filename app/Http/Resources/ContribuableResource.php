<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContribuableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'adresse_id' => $this->adresse_id,
            'nif' => $this->nif,
            'damaine_activity' => $this->damaine_activity,
            'description' => $this->description,

        ];
    }
}
