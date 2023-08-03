<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TauxImposambleUpdateRequest extends FormRequest
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
            'date' => ['required', 'date'],
            'min_montant' => ['required', 'numeric'],
            'max_montant' => ['required', 'numeric'],
            'taux_imposamble' => ['required', 'numeric'],
        ];
    }
}
