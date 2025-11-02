<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EneagramaUsuarioPreguntaRequest extends FormRequest
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
            'eneagrama_usuario_id' => [
                'required',
                'integer',
            ],

            'nueva_pregunta' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    // Validación de contenido seguro: permite solo letras, números, espacios y signos básicos
                    if (!preg_match('/^[\p{L}\p{N}\s.,;:!?()-]+$/u', $value)) {
                        $fail('El campo ' . $attribute . ' contiene caracteres inválidos.');
                    }
                }
            ],
        ];
    }
}
