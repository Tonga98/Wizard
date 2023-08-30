<?php

namespace App\Http\Requests;

use App\Models\Chofer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;

class UpdateChoferRequest extends FormRequest
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
            'nombre' => ['string', 'max:255'],
            'apellido' => ['string', 'max:255'],
            'dni_num' => ['integer', Rule::unique(Chofer::class)->ignore($this->chofer->id)],
            'email' => ['string', 'email', 'max:255', Rule::unique(Chofer::class)->ignore($this->chofer->id)],
            'ubicacion' => ['string', 'max:255'],
            'num_telefono' => ['integer', Rule::unique(Chofer::class)->ignore($this->chofer->id)],
            'camioneta_id' => ['integer','required'],
            'antecedentes_foto' => [File::types(['pdf', 'jpg', 'jpeg', 'png'])->max(4*1024)],
            'antecedentes_venc' => ['date'],
            'lic_conducir_venc' => ['date'],
            'lic_conducir_frente' => [File::types(['pdf', 'jpg', 'jpeg', 'png'])->max(4*1024)],
            'lic_conducir_dorso' => [File::types(['pdf', 'jpg', 'jpeg', 'png'])->max(4*1024)],
            'linti_venc' => ['date'],
            'dni_frente' => [File::types(['pdf', 'jpg', 'jpeg', 'png'])->max(4*1024)],
            'dni_dorso' => [File::types(['pdf', 'jpg', 'jpeg', 'png'])->max(4*1024)],
            'password' => ['confirmed', Password::defaults(), 'nullable'],
        ];
    }
}
