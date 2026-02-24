<?php

namespace App\Http\Requests\Kid;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class StoreKidPaymentRequest extends FormRequest{

    public function authorize(): bool{
        return true;
    }
    
    protected function prepareForValidation(): void{
        if ($this->has('amount')) {
            $this->merge([
                'amount' => str_replace(' ', '', $this->amount),
            ]);
        }
    }

    public function rules(): array{
        return [
            'kid_id' => ['required', 'integer', 'exists:kids,id'],
            'payment_type' => ['required', 'in:payment,discount,return'],
            'payment_method'        => ['required', 'in:cash,card,bank'],
            'amount'      => [
                'required', 
                'numeric', 
                'min:1',
                function ($attribute, $value, $fail) {
                    if ($this->tranzaksion === 'return') {
                        $this->checkKassaBalance($value, $fail);
                    }
                }
            ],
            'comment' => ['required', 'string', 'max:1000'],
        ];
    }

    protected function checkKassaBalance($amount, $fail): void{
        $kassa = DB::table('kassas')->first();
        if (!$kassa || ($kassa->{$this->payment_type} ?? 0) < $amount) {
            $currentAmount = $kassa ? ($kassa->{$this->payment_type} ?? 0) : 0;
            $fail(__('bolalar_show.kassada_yetarli_mablag_yoq') . number_format($currentAmount, 0, '.', ' ') . " UZS");
        }
    }

    public function messages(): array{
        return [
            'payment_method.required' => __('bolalar_show.teanzaksiya_turini_tanlang'),
            'payment_type.required'        => __('bolalar_show.tolov_turini_tanlang'),
            'amount.required'      => __('bolalar_show.tulov_summa_kiriting'),
            'amount.numeric'       => __('bolalar_show.summa_faqat_raqam_bolsin'),
            'comment.required' => __('bolalar_show.tolov_haqida_malumot_yozing'),
        ];
    }
}