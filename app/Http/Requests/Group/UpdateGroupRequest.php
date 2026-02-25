<?php

namespace App\Http\Requests\Group;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGroupRequest extends FormRequest{

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
            'id' => ['required', 'exists:groups,id'],
            'group_name' => [
                'required', 
                'string', 
                'max:255',
            ],
            'group_amount' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

}
