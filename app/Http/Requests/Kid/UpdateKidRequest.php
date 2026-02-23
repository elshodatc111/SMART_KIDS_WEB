<?php

namespace App\Http\Requests\Kid;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKidRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }
    
    protected function prepareForValidation(): void{
        $this->merge([
            'phone1' => $this->phone1 ? str_replace(' ', '', $this->phone1) : null,
            'phone2' => $this->phone2 ? str_replace(' ', '', $this->phone2) : null,
        ]);
    }

    public function rules(): array{
        return [
            'id'                => ['required', 'exists:kids,id'],
            'child_full_name'   => ['required', 'string', 'max:255'],
            'tkun'              => ['required', 'date'],
            'gender'            => ['required', 'in:male,female'],
            'parent_full_name'  => ['required', 'string', 'max:255'],
            'phone1'            => ['required', 'string', 'min:9'],
            'phone2'            => ['nullable', 'string'],
            'address'           => ['required', 'string', 'max:500'],
            'admin_note'        => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array{
        return [
            'child_full_name.required' => 'F.I.O. maydonini toʻldirish shart.',
            'tkun.required'            => 'Tugʻilgan sana kiritilishi shart.',
            'gender.required'          => 'Jinsni tanlang.',
            'phone1.required'          => 'Telefon raqami shart.',
        ];
    }
}
