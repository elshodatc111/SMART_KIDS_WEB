<?php

namespace App\Http\Requests\Lead;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreChildEmployeeRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }

    protected function prepareForValidation(): void{
        $phone1 = str_replace(' ', '', $this->phone1);
        $phone2 = str_replace(' ', '', $this->phone2);
        $certificate_serial = str_replace('_', '', strtoupper($this->certificate_serial_01) . '-' . $this->certificate_serial_02);
        $this->merge([
            'phone1' => $phone1,
            'phone2' => $phone2,
            'certificate_serial' => $certificate_serial,
        ]);
    }

    public function rules(): array{
        return [
            'child_full_name'      => ['required', 'string', 'max:255'],
            'gender'               => ['required', 'in:male,female'],
            'parent_full_name'     => ['required', 'string', 'max:255'],
            'phone1'               => ['required', 'string', 'min:9', 'max:20'],
            'phone2'               => ['required', 'string', 'min:9', 'max:20'],
            'address'              => ['required', 'string', 'max:500'],
            'tkun'                 => ['required', 'date', 'before:today'],
            'source'               => ['required', 'string'],
            'lovozim'              => ['required', 'string', 'max:255'],
            'certificate_serial'   => [
                'required', 
                'string', 
                Rule::unique('lead_kids', 'certificate_serial')
            ],
            'certificate_serial_01' => ['required', 'string'],
            'certificate_serial_02' => ['required'],
        ];
    }

    public function messages(): array{
        return [
            'child_full_name.required'    => 'FIO. maydonini toʻldirish shart.',
            'certificate_serial.unique'   => 'Ushbu seriya va raqamli guvohnoma allaqachon roʻyxatga olingan.',
            'certificate_serial_01.required' => 'Guvohnoma seriyasi kerak.',
            'certificate_serial_02.required' => 'Guvohnoma raqami kerak.',
            'gender.required'             => 'Jinsini tanlang.',
            'phone1.required'             => 'Telefon raqami kiritilishi shart.',
            'phone2.required'             => 'Qoʻshimcha telefon raqami kiritilishi shart.',
            'tkun.required'               => 'Tugʻilgan kunni kiriting.',
            'tkun.before'                 => 'Tugʻilgan kun kelajakda boʻlishi mumkin emas.',
            'source.required'             => 'Biz haqimizda qayerdan eshitganingizni tanlang.',
            'address.required'            => 'Manzilni kiriting.',
        ];
    }
    
}
