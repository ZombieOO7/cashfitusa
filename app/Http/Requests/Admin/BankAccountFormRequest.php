<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class BankAccountFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validator = [
            'bank_name' => 'required|max:'.config('constant.name_length'),
            'username' => 'required|max:'.config('constant.name_length'),
            'password' => 'required|max:'.config('constant.password_max_length').'|min:'.config('constant.password_min_length'),
            'account_number' => 'required|max:'.config('constant.name_length'),
            'routing_number' => 'required|max:'.config('constant.name_length'),
            // 'security_question' => 'required|max:'.config('constant.name_length'),
            // 'answer' => 'required|max:'.config('constant.name_length'),
            'credit_card_holder_name' => 'required_if:have_credit_card,==,1|max:'.config('constant.name_length'),
            'debit_card_holder_name' => 'required_if:have_debit_card,==,1|max:'.config('constant.name_length'),
            'credit_card_month' => 'required_if:have_credit_card,==,1',
            'debit_card_month' => 'required_if:have_debit_card,==,1',
            'credit_card_year' => 'required_if:have_credit_card,==,1',
            'debit_card_year' => 'required_if:have_debit_card,==,1',
            'debit_card_no' => 'required_if:have_debit_card,==,1',
            'credit_card_no' => 'required_if:have_credit_card,==,1',
            'credit_card_cvv' => 'required_if:have_credit_card,==,1|max:3',
            'debit_card_cvv' => 'required_if:have_debit_card,==,1|max:3',
        ];
        return $validator;
    }
}
