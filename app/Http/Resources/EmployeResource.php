<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'cni' => $this->cni,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'status_employe' => $this->status_employe,
            'salaire_base' => $this->salaire_base,
            'frais_deplacement' => $this->frais_deplacement,
            'indeminite_compansatoire' => $this->indeminite_compansatoire,
            'avantage_en_nature' => $this->avantage_en_nature,
            'contribuable_id' => $this->contribuable_id,
        ];
    }
}
