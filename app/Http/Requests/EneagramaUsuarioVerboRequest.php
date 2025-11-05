<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EneagramaUsuarioVerboRequest extends FormRequest
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

            'nuevo_verbo' => [
                'required',
                'string',
                'max:255',
                function ($attribute,$value, $fail) {
                    // Validación de contenido seguro: permite solo letras, números, espacios y signos básicos
                    if (!preg_match('/^[\p{L}\p{N}\s.,;:!?()-]+$/u', $value)) {
                        //esto complica el data.success
                        //throw ValidationException::withMessages([
                        //    $attribute => [
                        //        "title" => 'No se pudo crear la pregunta', //0
                        //        "data" => 'El campo ' . $attribute . ' contiene caracteres inválidos.' //1
                        //    ]
                        //]);

                        //esto no lo complica
                        $fail('El campo contiene caracteres inválidos.'); //solo texto
                    }
                }
            ],
        ];
    }
}
