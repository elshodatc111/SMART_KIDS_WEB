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
            'name.required' => 'Xodimning FIO kiratilishi shart.',
            'name.min' => 'Ism juda qisqa, kamida 3 ta belgi bo\'lishi kerak.',
            'phone1.unique' => 'Ushbu telefon raqami bilan xodim allaqachon ro\'yxatdan o\'tgan.',
            'phone1.required' => 'Telefon raqami kiritilishi shart.',
            'phone_two.required' => 'Qo\'shimcha telefon raqami kiritilishi shart.',
            'amount.required' => 'Maosh miqdori kiritilishi shart.',
            'amount.numeric' => 'Maosh faqat raqamlardan iborat bo\'lishi kerak.',
            'birthday.required' => 'Tug\'ilgan sana tanlanishi shart.',
            'birthday.before' => 'Tug\'ilgan sana bugungi kundan oldin bo\'lishi kerak.',
            'passport_number.required' => 'Pasport ma\'lumotlari shart.',
            'type.required' => 'Lavozimni tanlang.',
            'type.in' => 'Tanlangan lavozim tizimda mavjud emas.',
            'type_about.required' => 'Lavozim haqida qisqacha ma\'lumot yozing.',
        ];
    }
}
