<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdresseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'pays' => $this->pays,
            'province' => $this->province,
            'commune' => $this->commune,
            'colline' => $this->colline,
        ];
    }
}
