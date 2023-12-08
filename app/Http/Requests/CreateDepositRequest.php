<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDepositRequest extends FormRequest {
    public function authorize(): bool {
        return auth()->user()->id == $this->route('id');
    }

    public function rules(): array {
        return [
            'value'=> ['required', 'numeric', 'gte:0.01'],
        ];
    }

    public function messages(): array {
        return [
            'value.required' => 'O valor é obrigatória',
            'value.numeric' => 'O valor deve ser um número',
            'value.gte' => 'O valor deve ser maior que R$0.01',
        ];
    }
}
