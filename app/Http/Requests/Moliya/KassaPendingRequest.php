<?php

namespace App\Http\Requests\Moliya;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KassaPendingRequest extends FormRequest{
    public function authorize(): bool{
        return true; 
    }

    public function rules(): array{
        return [
            'id' => [
                'required',
                'integer',
                Rule::exists('moliya_histories', 'id')->where(function ($query) {
                    $query->where('status', 'pending');
                }),
            ],
        ];
    }

    public function messages(): array{
        return [
            'id.required' => __('kassa.id_kiriting'),
            'id.exists' => __('kassa.bunday_ariza_mavjud_emas'),
        ];
    }
    
}
