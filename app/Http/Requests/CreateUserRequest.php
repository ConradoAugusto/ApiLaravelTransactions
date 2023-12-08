<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool{
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
            'email' => ['required', 'email'],
            'name' => ['required'],
            'cpf' => ['required'],
            'password' => ['required', 'min:7', 'regex:/[a-zA-Z]/i'],
        ];
    }

    public function messages(): array {
        return [
            'email.required' => 'Email é obrigatório',
            'name.required' => 'Nome é obrigatório',
            'cpf.required' => 'CPF é obrigatório',
            'password.required' => 'Senha deve conter no mínimo 7 caracteres',
            'password.min' => 'Senha é obrigatório',
            'email.email' => 'O email deve ser um endereço válido',
        ];
    }
}
