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
            'child_full_name' => 'required|string|max:255',
            'child_dob' => 'required|date|before:today',
            'certificate_serial' => [
                'required', 
                'string', 
                'max:50', 
                Rule::unique('lead_kids', 'certificate_serial') // Takrorlanishni oldini oladi
            ],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'parent_full_name' => 'required|string|max:255',
            'phone1' => 'required|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'address' => 'required|string|max:500',
            'medical_conditions' => 'nullable|string',
            'target_group' => ['nullable', Rule::in(['small', 'middle', 'large', 'pre_school'])],
            'expected_arrival_date' => 'nullable|date|after_or_equal:today',
            'source' => ['nullable', Rule::in(['instagram', 'telegram', 'friend', 'other'])],
            'admin_note' => 'nullable|string',
        ];
    }

    public function messages(): array{
        return [
            'child_full_name.required' => 'Bolaning ism-sharifi majburiy.',
            'certificate_serial.unique' => 'Ushbu guvohnoma raqami bilan bola allaqachon ro‘yxatga olingan.',
            'child_dob.before' => 'Tug‘ilgan sana bugundan oldingi sana bo‘lishi kerak.',
            'expected_arrival_date.after_or_equal' => 'Kelish sanasi bugundan keyin bo‘lishi shart.',
        ];
    }
}
