<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeStoreRequest extends FormRequest
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
            'cni' => ['nullable', 'string', 'unique:employes,cni'],
            'nom' => ['nullable', 'string'],
            'prenom' => ['nullable', 'string'],
            'status_employe' => ['nullable', 'string'],
            'salaire_base' => ['required', 'numeric'],
            'frais_deplacement' => ['required', 'numeric'],
            'indeminite_compansatoire' => ['nullable', 'numeric'],
            'avantage_en_nature' => ['nullable', 'numeric'],
            'contribuable_id' => ['required', 'integer', 'exists:contribuables,id'],
        ];
    }
}


