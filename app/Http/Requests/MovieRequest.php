<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @mixin \Illuminate\Http\Request
 */
class MovieRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:100',
            'year' => 'required|integer|min:1800|max:2030',
            'director_id' => 'required|exists:artists,id',
            'country_id' => 'required|exists:countries,id',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}
