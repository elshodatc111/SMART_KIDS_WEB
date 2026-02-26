<?php

namespace App\Http\Requests\Emploes;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest{
    public function authorize(): bool{
        return true; // Ruxsatni true qiling
    }
    protected function prepareForValidation(){
        $this->merge([
            // Telefon va maoshdagi hamma bo'shliqlarni olib tashlaydi
            'phone' => str_replace(' ', '', $this->phone),
            'phone_two' => str_replace(' ', '', $this->phone_two),
            'amount' => str_replace(' ', '', $this->amount),
        ]);
    }

    public function rules(): array{
        return [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'phone_two' => 'nullable|string|max:20',
            'passport_number' => 'nullable|string|max:20',
            'address' => 'required|string|max:500',
            'amount' => 'required|numeric', // Endi bu raqam ko'rinishida
            'birthday' => 'required|date',
            'type_about' => 'required|string',
            'type' => 'required|string|in:drektor,admin,katta_tarbiyachi,kichik_tarbiyachi,oshpaz,teacher,farrosh,hodim',
        ];
    }
}
