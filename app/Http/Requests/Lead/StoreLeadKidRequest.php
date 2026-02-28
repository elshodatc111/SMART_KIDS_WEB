<?php

namespace App\Http\Requests\Lead;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLeadKidRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            // Bola FIO
            'child_full_name' => 'required|string|max:255',
            // Guvohnoma raqam
            'certificate_serial' => ['required', 'string','max:50',],
            // Tugilgan kuni
            'tkun' => 'required|date',
            // Jinsi
            'gender' => ['required', Rule::in(['male', 'female'])],
            // Otasi yoki onasining fio
            'parent_full_name' => 'required|string|max:255',
            // Telefon raqam
            'phone1' => 'required|string|max:20',
            // Qo'shimcha telefon raqam
            'phone2' => 'nullable|string|max:20',
            // Yashash manzili
            'address' => 'required|string|max:500',
            // Biz haqimizda
            'source' => ['nullable', Rule::in(['instagram', 'telegram', 'friend', 'other'])],
            // Qoshimcha izoh
            'admin_note' => 'nullable|string',
        ];
    }
    
    public function messages(): array{
        return [
            'child_full_name.required' => 'Bolaning ism-sharifi majburiy.',
            'tkun.before' => 'Tug‘ilgan sana bugundan oldingi sana bo‘lishi kerak.',
        ];
    }
}
