<?php

namespace App\Http\Requests\Moliya;

use App\Models\Moliya;
use Illuminate\Foundation\Http\FormRequest;


class BalansToKassaRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    protected function prepareForValidation(){
        if ($this->has('amount')) {
            $this->merge([
                'amount' => preg_replace('/\s+/', '', $this->amount),
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
    public function withValidator($validator){
        $validator->after(function ($validator) {
            $method = $this->payment_method;
            $amount = $this->amount;
            $moliya = Moliya::first();
            if (!$moliya) {
                $validator->errors()->add('amount', 'Tizimda moliya ma’lumotlari topilmadi.');
                return;
            }
            $balanceColumn = $method; 
            if ($moliya->$balanceColumn < $amount) {
                $validator->errors()->add('amount', "Balansda yetarli mablag' mavjud emas. (Joriy balans: " . number_format($moliya->$balanceColumn) . " so'm)");
            }
        });
    }

    public function messages(): array{
        return [
            'amount.required' => 'Summani kiritish majburiy.',
            'amount.numeric' => 'Summa faqat raqamlardan iborat bo‘lishi kerak.',
            'payment_method.required' => 'O‘tkazma turini tanlang.',
            'description.required' => 'Tavsif yozish majburiy.',
        ];
    }
}
