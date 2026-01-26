<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenreRequest extends FormRequest
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
            'name' => ['sometimes', 'required', 'string', 'between:3,32', 'unique:genres,name']
        ];
    }

    public function messages(): array {
        return [
            'name.required' => 'Es obligatorio añadir un nombre al género',
            'name.string' => 'El nombre del género debe ser una cadena de texto',
            'name.between' => 'La longitud del nombre debe ser superior a 3 caracteres e inferior a 32',
            'name.unique' => 'El género con ese nombre ya existe'
        ];
    }
}
