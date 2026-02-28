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
            // FIO 
            'full_name' => 'required|string|max:255',
            //Telefon raqam 
            'phone1' => 'required|string|max:20',
            //Telefon raqam
            'phone2' => 'nullable|string|max:20',
            //Yashash manzili
            'address' => 'required|string|max:500',
            //Tugilgan kuni 
            'date_of_birth' => 'required|date|before:today',    
            //Ma'lumoti
            'education_level' => ['required', Rule::in(['College', 'Bachelor', 'Master', 'Doctor'])],
            //Ta'lim olgon joy nomi
            'education_detail' => 'required|string',            
            //Oxirgi ish joyi
            'previous_company' => 'nullable|string|max:255',
            //Ishga kirishdan maqsadi
            'career_objective' => 'nullable|string',
            //Kutayotgan ish haqi
            'expected_salary' => 'nullable|string|max:100',     
            //E'lonni qayerdan ko'rdingiz?
            'vacance_about' => ['nullable', Rule::in(['social_media', 'friend', 'other'])],
            //Qaysi lavozimga nomzod?
            'lovozim' => ['nullable', Rule::in(['admin','katta_tarbiyachi','kichik_tarbiyachi','oshpaz','teacher','farrosh'])],
        ];
    }
    public function messages(): array{
        return [
            'full_name.required' => 'Foydalanuvchi ism-sharifi majburiy.',
            'phone1.required' => 'Asosiy telefon raqami majburiy.',
            'education_level.required' => 'Maʼlumot darajasini tanlash majburiy.',
            'date_of_birth.date' => 'Tugʻilgan sana notoʻgʻri formatda.',
        ];
    }
}
