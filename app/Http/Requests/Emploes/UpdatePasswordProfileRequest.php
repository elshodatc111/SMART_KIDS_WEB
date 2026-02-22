<?php

namespace App\Http\Requests\Emploes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordProfileRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'current_password' => ['required', 'current_password'], // Joriy parolni avtomatik tekshiradi
            'password' => [
                'required', 
                'confirmed', 
                Password::min(8)->mixedCase()->numbers()->symbols() // Xavfsiz parol talablari
            ],
        ];
    }
    public function messages(): array{
        return [
            'current_password.current_password' => __('profile_page.current_password_current_password'),
            'password.required' => __('profile_page.password_required'),
            'password.confirmed' => __('profile_page.password_confirmed'),
            'password.min' => __('profile_page.password_min'),
            'password.mixed' => __('profile_page.password_mixed'),
            'password.numbers' => __('profile_page.password_numbers'),
            'password.symbols' => __('profile_page.password_symbols'),
        ];
    }
}
