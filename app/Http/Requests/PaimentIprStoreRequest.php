<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaimentIprStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'contribuable_id' => ['required', 'integer', 'exists:contribuables,id'],
            'employe_id' => ['required', 'integer', 'exists:employes,id'],
            'date_paiement' => ['required', 'date'],
            'montant_employe' => ['required', 'numeric'],
            'montant_employeur' => ['required', 'numeric'],
            'total_paiement' => ['nullable', 'numeric'],
        ];
    }
}
