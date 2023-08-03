<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaimentIprResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'contribuable_id' => $this->contribuable_id,
            'employe_id' => $this->employe_id,
            'date_paiement' => $this->date_paiement,
            'montant_employe' => $this->montant_employe,
            'montant_employeur' => $this->montant_employeur,
            'total_paiement' => $this->total_paiement,
        ];
    }
}
