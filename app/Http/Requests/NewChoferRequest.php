<?php

namespace App\Http\Requests;

use App\Models\Chofer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\File;


class NewChoferRequest extends FormRequest
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
            'dni_num' => ['required', 'numeric', Rule::unique(Chofer::class)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(Chofer::class)],
            'ubicacion' => ['required', 'string', 'max:255'],
            'num_telefono' => ['required', 'integer', Rule::unique(Chofer::class)],
            'antecedentes_foto' => [File::types(['pdf', 'jpg', 'jpeg', 'png'])->max(4*1024)],
            'antecedentes_venc' => ['required', 'date'],
            'lic_conducir_venc' => ['required', 'date'],
            'lic_conducir_frente' => [File::types(['pdf', 'jpg', 'jpeg', 'png'])->max(4*1024)],
            'lic_conducir_dorso' => [ File::types(['pdf', 'jpg', 'jpeg', 'png'])->max(4*1024)],
            'linti_venc' => ['required', 'date'],
            'dni_frente' => [File::types(['pdf', 'jpg', 'jpeg', 'png'])->max(4*1024)],
            'dni_dorso' => [File::types(['pdf', 'jpg', 'jpeg', 'png'])->max(4*1024)],
            'id_camioneta' => ['required'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}
