<?php

namespace App\Http\Requests\Group;

use Illuminate\Foundation\Http\FormRequest;

class DeleteGroupRequest extends FormRequest{

    public function authorize(): bool{
        return true; 
    }

    public function rules(): array{
        return [
            'id' => [
                'required',
                'integer',
                'exists:groups,id',
            ],
        ];
    }

    public function messages(): array{
        return [
            'id.required' => __('groups.guruh_id_topilmadi'),
            'id.exists'   => __('groups.guruh_mavjud_emas'),
        ];
    }
}
