<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArtistRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:20',
            'firstname' => 'required|string|min:3|max:15',
            'birthdate' => 'required|integer|min:1902|max:2023',
            'country_id' => 'required|exists:countries,id',
            'acteur-photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}
