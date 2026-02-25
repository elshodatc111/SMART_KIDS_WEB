<?php

namespace App\Http\Requests\Group;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteGroupTarbiyachiRequest extends FormRequest{

    public function authorize(): bool{
        return true; 
    }

    public function rules(): array{
        return [
            'id' => [
                'required',
                'integer',
                Rule::exists('group_users', 'id')->where(function ($query) {
                    $query->where('status', 'active');
                }),
            ],
        ];
    }

    public function messages(): array{
        return [
            'id.required' => __('groups.tarbiyachi_id_topilmadi'),
            'id.exists'   => __('groups.tarbiyachi_delete_error'),
        ];
    }
}
