<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;
use App\Models\Guarda;

class UpdateGuardaRequest extends FormRequest
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
            'nombre' => [ 'string', 'max:255'],
            'apellido' => [ 'string', 'max:255'],
            'dni_num' => [ 'numeric',Rule::unique(Guarda::class)->ignore($this->guarda->id)],
            'email' => [ 'string', 'email', 'max:255', Rule::unique(Guarda::class)->ignore($this->guarda->id)],
            'ubicacion' => [ 'string', 'max:255'],
            'num_telefono' => [ 'integer',Rule::unique(Guarda::class)->ignore($this->guarda->id)],
            'antecedentes_foto' => [File::types(['pdf', 'jpg', 'jpeg', 'png'])->max(4*1024)],
            'antecedentes_venc' => [ 'date'],
            'dni_frente' => [File::types(['pdf', 'jpg', 'jpeg', 'png'])->max(4*1024)],
            'dni_dorso' => [File::types(['pdf', 'jpg', 'jpeg', 'png'])->max(4*1024)],
            'camioneta_id'=> ['integer'],
            'password' => ['confirmed', Password::defaults(), 'nullable'],
        ];
    }
}
