<?php

namespace App\Http\Requests\Kid;

use Illuminate\Foundation\Http\FormRequest;

class StoreKidRequest2 extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    protected function prepareForValidation(): void{
        $serial = null;
        if ($this->certificate_serial1 && $this->certificate_serial2) {
            $serial = str_replace("_","",strtoupper($this->certificate_serial1) . '-' . $this->certificate_serial2);
        }
        $phone1 = $this->phone1 ? str_replace(' ', '', $this->phone1) : null;
        $phone1 = $this->phone1 ? str_replace(' ', '', $this->phone1) : null;
        $phone2 = $this->phone2 ? str_replace(' ', '', $this->phone2) : null;
        $this->merge([
            'certificate_serial' => $serial,
            'phone1' => $phone1,
            'phone2' => $phone2,
        ]);
    }
    public function rules(): array{
        return [
            'id' => ['required'],
            'child_full_name'    => ['required', 'string', 'max:255'],
            'certificate_serial' => ['required', 'string', 'unique:kids,certificate_serial'],
            'tkun'               => ['required', 'date'],
            'gender'             => ['required', 'in:male,female'],
            'parent_full_name'   => ['required', 'string', 'max:255'],
            'phone1'             => ['required', 'string', 'min:9'],
            'phone2'             => ['nullable', 'string'], 
            'address'            => ['required', 'string'],
            'admin_note'         => ['nullable', 'string'],
        ];
    }
    public function messages(): array{
        return [
            'certificate_serial.unique' => __('bolalar.error1'),
            'child_full_name.required'  => __('bolalar.error2'),
        ];
    }
}
