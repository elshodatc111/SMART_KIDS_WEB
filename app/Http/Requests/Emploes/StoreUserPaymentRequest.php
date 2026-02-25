<?php

namespace App\Http\Requests\Emploes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class StoreUserPaymentRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    protected function prepareForValidation(){
        if ($this->has('amount')) {
            $this->merge([
                'amount' => str_replace(' ', '', $this->amount),
            ]);
        }
    }

    public function rules(): array{
        return [
            'user_id'        => 'required|exists:users,id',
            'payment_method' => 'required|in:cash,card,bank',
            'amount'         => 'required|numeric|min:1',
            'description'    => 'nullable|string|max:500',
        ];
    }

    public function withValidator($validator){
        $validator->after(function ($validator) {
            $method = $this->payment_method;
            $amount = $this->amount;
            $kassa = DB::table('kassas')->first();
            if (!$kassa) {
                $validator->errors()->add('amount', __('emploes_page.kassa_jadvali_topilmadi'));
            }
            if($method === 'cash') {
                $method = 'naqt';
            }  
            if ($kassa->$method < $amount) {
                $formattedBalance = number_format($kassa->$method, 0, '.', ' ');
                $validator->errors()->add('amount', __('emploes_page.kassada_mablag_yetarli_emas') . $formattedBalance . " UZS");
            }
        });
    }

    public function messages(): array{
        return [
            'amount.numeric' => __('emploes_page.ish_haqi_summasi_raqamlardan_iborat_bolishi_kerak'),
            'amount.min'     => __('emploes_page.tulov_summasi_kamida_1_som_bolishi_kerak'),
        ];
    }

}
