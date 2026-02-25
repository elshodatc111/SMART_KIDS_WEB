<?php

namespace App\Http\Requests\Group;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGroupTarbiyachiRequest extends FormRequest{

    public function authorize(): bool{
        return true; 
    }
    public function rules(): array{
        return [
            'id' => ['required', 'exists:groups,id'],
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('group_users', 'user_id')->where(function ($query) {
                    $query->where('status', 'active');
                }),
            ],
        ];
    }
    public function messages(): array{
        return [
            'id.exists' => __('groups.tanlangan_guruh_mavjud_emas'),
            'user_id.required' => __('groups.tanlangan_tarbiyachi_mavjud_emas'),
            'user_id.exists' => __('groups.tanlangan_foydalanuvchi_mavjud_emas'),
            'user_id.unique' => __('groups.tanlangan_tarbiyachi_boshqa_guruhda_bor'),
        ];
    }
}
