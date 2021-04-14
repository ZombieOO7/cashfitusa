<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class WithdrawTransactionFormRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $validator = [
            'user_id' => ['required'],
            'date' =>['required'],
            'amount' =>['required','max:'.config('constant.amount_length')],
            'description' =>['required','max:'.config('constant.content_length')],
        ];
        return $validator;
    }
}
