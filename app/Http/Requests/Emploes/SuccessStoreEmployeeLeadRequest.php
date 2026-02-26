<?php

namespace App\Http\Requests\Emploes;

use Illuminate\Foundation\Http\FormRequest;

class SuccessStoreEmployeeLeadRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    protected function prepareForValidation(){
        $this->merge([
            'phone1' => str_replace(' ', '', $this->phone1),
            'phone_two' => str_replace(' ', '', $this->phone_two),
            'amount' => str_replace(' ', '', $this->amount),
            'passport_number' => str_replace(' ', '', strtoupper($this->passport_number)),
        ]);
    }
    
    public function rules(): array{
        return [
            'lead_id' => 'required',
            'name' => 'required|string|min:3|max:255',
            'phone1' => 'required|string|min:9|max:20|unique:users,phone',
            'phone_two' => 'required|string|min:9|max:20',
            'address' => 'required|string|max:500',
            'amount' => 'required|numeric|min:0',
            'birthday' => 'required|date|before:today',
            'passport_number' => 'required|string|max:20',
            'type' => 'required|string|in:drektor,admin,katta_tarbiyachi,kichik_tarbiyachi,oshpaz,teacher,farrosh,hodim',
            'type_about' => 'required|string',
        ];
    }

    public function messages(): array{
        return [
            'name.required' => __('lead_emploes_page.name_required'),
            'name.min' => __('lead_emploes_page.name_min'),
            'phone1.unique' => __('lead_emploes_page.phone1_unique'),
            'phone1.required' => __('lead_emploes_page.phone1_required'),
            'phone_two.required' => __('lead_emploes_page.phone_two_required'),
            'amount.required' => __('lead_emploes_page.amount_required'),
            'amount.numeric' => __('lead_emploes_page.amount_numeric'),
            'birthday.required' => __('lead_emploes_page.birthday_required'),
            'birthday.before' => __('lead_emploes_page.birthday_before'),
            'passport_number.required' => __('lead_emploes_page.passport_number_required'),
            'type.required' => __('lead_emploes_page.type_required'),
            'type.in' => __('lead_emploes_page.type_in'),
            'type_about.required' => __('lead_emploes_page.type_about_required'),
        ];
    }
}
