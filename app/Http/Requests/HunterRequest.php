<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HunterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return match ($this->method())
        {
            'POST' => [
                'nome_hunter' => 'required|max:50',
                'idade_hunter' => 'required|integer|min:13',
                'altura_hunter' => 'required|numeric|min:1.50|max:2.50',
                'peso_hunter' => 'required|numeric|min:50.00|max:150.00',
                'tipo_hunter_id' => 'required|exists:tipos_hunters,_id',
                'tipo_nen_id' => 'required|exists:tipos_nens,_id',
                'tipo_sangue_id' => 'required|exists:tipos_sanguineos,_id',
                'inicio' => 'required|date|after_or_equal:today',
                'termino' => 'required|date|after_or_equal:inicio',
            ],
            'PATCH' => [
                'nome_hunter' => 'required|max:50',
                'idade_hunter' => 'required|integer|min:13',
                'altura_hunter' => 'required|numeric|min:1.50|max:2.50',
                'peso_hunter' => 'required|numeric|min:50.00|max:150.00',
                'tipo_hunter_id' => 'required|exists:tipos_hunters,_id',
                'tipo_nen_id' => 'required|exists:tipos_nens,_id',
                'tipo_sangue_id' => 'required|exists:tipos_sanguineos,_id',
                'inicio' => 'required|date|after_or_equal:today',
                'termino' => 'required|date|after_or_equal:inicio',
            ],
        };
    }
}
