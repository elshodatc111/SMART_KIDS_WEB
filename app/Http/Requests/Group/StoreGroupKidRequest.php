<?php

namespace App\Http\Requests\Group;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGroupKidRequest extends FormRequest{
    public function authorize(): bool{
        return true; 
    }
    public function rules(): array{
        return [
            'id' => ['required', 'exists:groups,id'],
            'kid_id' => [
                'required',
                'exists:kids,id',
                Rule::unique('group_kids', 'kid_id')->where(function ($query) {
                    $query->where('status', 'active');
                }),
            ],
            'description' => ['required', 'string', 'max:500'],
        ];
    }

    public function messages(): array{
        return [
            'id.exists' => __('groups.tanlangan_guruh_topilmadi'),
            'kid_id.required' => __('groups.bolani_tanlash_majburiy'),
            'kid_id.exists' => __('groups.bunday_bola_mavjud_emas'),
            'kid_id.unique' => __('groups.bola_guruhda_aktiv'),
            'description.required' => __('groups.guruhga_qoshish_izohi_majburiy'),
        ];
    }
}
