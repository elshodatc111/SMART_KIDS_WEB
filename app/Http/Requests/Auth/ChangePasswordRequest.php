<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest{
    
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'], // confirmed -> new_password_confirmation bo'lishini talab qiladi
        ];
    }
    public function messages(): array{
        return [
            'current_password.required' => 'Amaldagi parolni kiritishingiz shart.',
            'new_password.min' => 'Yangi parol kamida 8 ta belgidan iborat bo\'lishi kerak.',
            'new_password.confirmed' => 'Yangi parollar bir-biriga mos kelmadi.',
        ];
    }
}
