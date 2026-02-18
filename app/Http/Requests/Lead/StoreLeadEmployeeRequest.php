<?php

namespace App\Http\Requests\Lead;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLeadEmployeeRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'full_name' => 'required|string|max:255',
            'phone1' => 'required|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'address' => 'required|string|max:500',
            'date_of_birth' => 'required|date|before:today',            
            // Ma'lumoti
            'education_level' => ['required', Rule::in(['College', 'Bachelor', 'Master', 'Doctor'])],
            'education_detail' => 'required|string',            
            // Ish tajribasi
            'previous_company' => 'nullable|string|max:255',
            'position_applied' => 'nullable|string|max:255',
            'years_of_experience' => 'nullable|string|max:50',
            'career_objective' => 'nullable|string',
            'expected_salary' => 'nullable|string|max:100',            
            // Qo'shimcha
            'gender' => ['required', Rule::in(['male', 'female'])],            
            // Lead tahlili
            'vacance_about' => ['nullable', Rule::in(['social_media', 'friend', 'other'])],
            'vacance_about_other' => 'required_if:vacance_about,other|nullable|string|max:255',            
            'vacance_looking_for' => ['nullable', Rule::in(['job', 'career_growth', 'experience', 'other'])],
            'vacance_looking_for_other' => 'required_if:vacance_looking_for,other|nullable|string|max:255',
        ];
    }
    public function messages(): array{
        return [
            'full_name.required' => 'Foydalanuvchi ism-sharifi majburiy.',
            'phone1.required' => 'Asosiy telefon raqami majburiy.',
            'education_level.required' => 'Maʼlumot darajasini tanlash majburiy.',
            'date_of_birth.date' => 'Tugʻilgan sana notoʻgʻri formatda.',
            'vacance_about_other.required_if' => 'Agar "Boshqa" tanlangan boʻlsa, manbani yozishingiz kerak.',
        ];
    }
}
