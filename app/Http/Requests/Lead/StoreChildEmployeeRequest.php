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
            'admin_note'              => ['required', 'string', 'max:255'],
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
            'child_full_name.required'    => __('lead_kid_page.child_full_name_required'),
            'certificate_serial.unique'   => __('lead_kid_page.certificate_serial_unique'),
            'certificate_serial_01.required' => __('lead_kid_page.certificate_serial_01_required'),
            'certificate_serial_02.required' => __('lead_kid_page.certificate_serial_02_required'),
            'gender.required'             => __('lead_kid_page.gender_required'),
            'phone1.required'             => __('lead_kid_page.phone1_required'),
            'phone2.required'             => __('lead_kid_page.phone2_required'),
            'tkun.required'               => __('lead_kid_page.tkun_required'),
            'tkun.before'                 => __('lead_kid_page.tkun_before'),
            'source.required'             => __('lead_kid_page.source_required'),
            'address.required'            => __('lead_kid_page.address_required'),
        ];
    }
    
}
