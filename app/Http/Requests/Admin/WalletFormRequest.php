<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class WalletFormRequest extends FormRequest
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
            'wallet_balance' =>['required','max:'.config('constant.amount_length')],
            'transfer_amount' =>['required','max:'.config('constant.amount_length')],
            'withdrawal_amount' =>['required','max:'.config('constant.amount_length')],
        ];
        return $validator;
    }
}
