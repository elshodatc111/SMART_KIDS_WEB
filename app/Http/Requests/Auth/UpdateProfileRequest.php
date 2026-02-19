<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        $userId = $this->user()->id; // Hozirgi foydalanuvchi ID si

        return [
            'name' => ['required', 'string', 'max:255'],
            'phone_two' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'birthday' => ['nullable', 'date'],
            'passport_number' => ['nullable', 'string', 'max:20'],
        ];
    }
}
