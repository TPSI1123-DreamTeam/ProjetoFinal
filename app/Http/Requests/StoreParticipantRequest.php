<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreParticipantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // POR RAZÕES DE TESTE ESTE RETURN ESTÁ A TRUE. CONVÉM ALTERAR PARA FALSE MAIS TARDE QUANDO A APLICAÇÃO ESTIVER COMPLETA E FORA DE AMBIENTE DE TESTES
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
         //   'password' => 'required|string',
        ];
    }
}
