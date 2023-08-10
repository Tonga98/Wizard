<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Guarda;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class NewGuardaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'apellido' => ['required', 'string', 'max:255'],
            'dni_num' => ['required', 'numeric',Rule::unique(Guarda::class)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(Guarda::class)],
            'ubicacion' => ['required', 'string', 'max:255'],
            'num_telefono' => ['required', 'integer',Rule::unique(Guarda::class)],
            'antecedentes_foto' => [ 'image', 'mimes: jpg, jpeg, png'],
            'antecedentes_venc' => ['required', 'date'],
            'dni_frente' => ['image',  'mimes: jpg, jpeg, png'],
            'dni_dorso' => ['image',  'mimes: jpg, jpeg, png'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}
