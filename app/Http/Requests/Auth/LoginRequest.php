<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest{

    public function authorize(): bool{
        return true; 
    }
    public function rules(): array{
        return [
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function messages(): array{
        return [
            'phone.required' => 'Telefon raqamini kiriting.',
            'password.required' => 'Parolni kiriting.',
            'password.min' => 'Parol kamida 8 ta belgidan iborat bo\'lishi kerak.',
        ];
    }
    
}
