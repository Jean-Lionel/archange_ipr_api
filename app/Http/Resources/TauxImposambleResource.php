<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TauxImposambleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'min_montant' => $this->min_montant,
            'max_montant' => $this->max_montant,
            'taux_imposamble' => $this->taux_imposamble,
        ];
    }
}
