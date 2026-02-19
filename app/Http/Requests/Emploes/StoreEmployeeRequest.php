<?php

namespace App\Http\Requests\Emploes;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest{
    public function authorize(): bool{
        return true; // Avtorizatsiyani yoqish
    }
    protected function prepareForValidation(){
        $this->merge([
            'phone' => "+" . preg_replace('/[^0-9]/', '', $this->phone),
            'phone_two' => "+" . preg_replace('/[^0-9]/', '', $this->phone_two),
            'amount' => str_replace(' ', '', $this->amount),
        ]);
    }
    public function rules(): array{
        return [
            'name' => 'required|string|max:255', 
            'phone' => 'required|string|unique:users,phone', 
            'phone_two' => 'required|string', 
            'address' => 'required|string|max:500',
            'amount' => 'required|string',
            'birthday' => 'required|date',
            'passport_number' => 'required|string|max:10|unique:users,passport_number', 
            'type' => 'required|in:drektor,admin,katta_tarbiyachi,kichik_tarbiyachi,oshpaz,teacher,farrosh,hodim',
            'type_about' => 'required|string',
        ];
    }
    public function messages(): array {
        return [
            'name.required'            => __('emploes_page.validate.name_required'),
            'phone.required'           => __('emploes_page.validate.phone_required'),
            'phone.unique'             => __('emploes_page.validate.phone_unique'),
            'passport_number.required' => __('emploes_page.validate.passport_number_required'),
            'passport_number.unique'   => __('emploes_page.validate.passport_number_unique'),
            'type.required'            => __('emploes_page.validate.type_required'),
            'amount.required'          => __('emploes_page.validate.amount_required'),
        ];
    }
}
