<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecompensaRequest extends FormRequest
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
                'descricao_recompensa' => 'required',
                'valor_recompensa' => 'required|numeric|min:0.00|max:1000000.00',
            ],
            'PATCH' => [
                'descricao_recompensa' => 'required',
                'valor_recompensa' => 'required|numeric|min:0.00|max:1000000.00',
            ],
        };
    }
}
