<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContribuableStoreRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'adresse_id' => ['required', 'integer', 'exists:adresses,id'],
            'nif' => ['required', 'string', 'unique:contribuables,nif'],
            'damaine_activity' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }
}
