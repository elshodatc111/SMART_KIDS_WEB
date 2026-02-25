<?php

namespace App\Http\Requests\Group;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }
    
    protected function prepareForValidation(): void{
        if ($this->has('group_amount')) {
            $this->merge([
                'group_amount' => str_replace([' ', "\xc2\xa0"], '', $this->group_amount),
            ]);
        }
    }
    
    public function rules(): array{
        return [
            'group_name'   => ['required', 'string', 'max:255'],
            'group_amount' => ['required', 'numeric', 'min:0'],
            'description'  => ['required', 'string', 'max:1000'],
        ];
    }
    
    public function messages(): array{
        return [
            'group_name.required'   => __('groups.request_guruh_nomi'),
            'group_amount.required' => __('groups.request_guruh_narxi'),
            'description.required'  => __('groups.request_guruh_haqida'),
        ];
    }
}
