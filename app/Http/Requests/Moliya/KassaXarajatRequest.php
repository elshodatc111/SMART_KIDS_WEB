<?php

namespace App\Http\Requests\Moliya;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class KassaXarajatRequest extends FormRequest{

    public function authorize(): bool{
        return true; // Foydalanuvchi ruxsatini bu yerda tekshirishingiz mumkin
    }

    protected function prepareForValidation(): void{
        if ($this->has('amount')) {
            $this->merge([
                'amount' => str_replace([' ', "\xc2\xa0"], '', $this->amount),
            ]);
        }
    }

    public function rules(): array{
        return [
            'amount' => ['required', 'numeric', 'min:1'],
            'payment_method' => ['required', 'in:cash,card,bank'],
            'description' => ['required', 'string', 'max:500'],
        ];
    }
    
    public function withValidator(Validator $validator): void{
        $validator->after(function ($validator) {
            if ($validator->errors()->any()) {
                return;
            }
            $balance = DB::table('kassas')->first(); 
            if (!$balance) {
                $validator->errors()->add('amount', __('kassa.moliya_topilmadi'));
                return;
            }
            $method = $this->payment_method;
            if($method === 'cash'){
                $currentBalance = $balance->naqt;
            } elseif($method === 'card'){
                $currentBalance = $balance->card;
            } elseif($method === 'bank'){
                $currentBalance = $balance->bank;
            } else {
                $validator->errors()->add('payment_method', __('kassa.noto_gri_xarajat_turi'));
                return;
            }
            if ($this->amount > $currentBalance) {
                $validator->errors()->add(
                    'amount', 
                    __('kassa.balansda_yetishmaydi') . number_format($currentBalance, 0, '.', ' ')
                );
            }
        });
    }

    public function messages(): array{
        return [
            'amount.required' => __('kassa.xarajat_summa'),
            'amount.numeric' => __('kassa.summa_numeric'),
            'payment_method.required' => __('kassa.xarajat_turi'),
            'description.required' => __('kassa.xarajat_haqida'),
        ];
    }
}
