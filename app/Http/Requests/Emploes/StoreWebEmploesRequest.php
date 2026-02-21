<?php

namespace App\Http\Requests\Emploes;
use Illuminate\Foundation\Http\FormRequest;

class StoreWebEmploesRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    protected function prepareForValidation(){
        $this->merge([
            'phone1' => str_replace([' ', '-', '(', ')'], '', $this->phone1),
            'phone2' => str_replace([' ', '-', '(', ')'], '', $this->phone2),
        ]);
    }

    public function rules(): array{
        return [
            'full_name' => 'required|string|max:255',
            'phone1' => ['required', 'string', 'regex:/^\+998[0-9]{9}$/'],
            'phone2' => ['required', 'string', 'regex:/^\+998[0-9]{9}$/'],
            'address' => 'required|string',
            'date_of_birth' => 'required|date',
            'education_level' => 'required|in:College,Bachelor,Master,Doctor',
            'education_detail' => 'required|string',
            'previous_company' => 'required|string',
            'career_objective' => 'required|string',
            'expected_salary' => 'required|string',
            'lovozim' => 'required|string',
            'vacance_about' => 'required|in:social_media,friend,other',
        ];
    }

    public function messages(): array{
        return [
            'phone1.regex' => __('lead_emploes_page.error_one'),
            'phone2.regex' =>  __('lead_emploes_page.error_phone'),
            'required' => __('lead_emploes_page.error_maydon'),
        ];
    }

}
