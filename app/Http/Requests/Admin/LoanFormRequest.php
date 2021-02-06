<?php

namespace App\Http\Requests\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class LoanFormRequest extends FormRequest
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
            'first_name' => 'required|max:'.config('constant.name_length'),
            'last_name' => 'required|max:'.config('constant.name_length'),
            'middle_name' => 'required|max:'.config('constant.name_length'),
            // 'email' => ['required','max:'.config('constant.email_length')],
            'phone1'=>['required','max:'.config('constant.max_phone_length')],
            'phone2'=>['required','max:'.config('constant.max_phone_length')],
            'address1'=>['required','max:'.config('constant.text_length')],
            'address2'=>['required','max:'.config('constant.text_length')],
            'city'=>['required','max:'.config('constant.name_length')],
            'state'=>['required','max:'.config('constant.name_length')],
            'zip_code'=>['required','max:'.config('constant.zip_code_length')],
            'bank_name' =>'required|max:'.config('constant.name_length'),
            'account_type' => 'required',
            'account_number' => 'required|max:'.config('constant.name_length'),
            // 'confirm_account_number' => 'required|max:'.config('constant.name_length').'|same:account_number',
            'bank_address' =>'required|max:'.config('constant.text_length'),
            'loan_amount' => 'required|max:'.config('constant.amount_length'),
            'months' => 'required|max:'.config('constant.name_length'),
            'repayment_amount' =>'required|max:'.config('constant.name_length'),
            'past_loan' => 'required',
            'routing_number' => 'required|max:'.config('constant.name_length'),
            // 'password' => 'required|max:'.config('constant.password_max_length').'|min:'.config('constant.password_min_length'),
        ];
        if ($request->has('id') && $request->id != null) {
            // $validator['email'][] = 'unique:users,email,' . $request->id.',id,deleted_at,NULL';
            // $validator['phone1'][] = 'unique:users,phone1,' . $request->id.',id,deleted_at,NULL';
            // $validator['phone2'][] = 'unique:users,phone2,' . $request->id.',id,deleted_at,NULL';
        } else {
            // $validator['email'][] = 'unique:users,email,NULL,id,deleted_at,NULL';
            // $validator['phone1'][] = 'unique:users,phone1,NULL,id,deleted_at,NULL';
            // $validator['phone2'][] = 'unique:users,phone2,NULL,id,deleted_at,NULL';
            // $validator['password'] = 'required|max:'.config('constant.password_max_length').'|min:'.config('constant.password_min_length');
            // $validator['confirm_password'] = 'required|same:password|max:'.config('constant.password_max_length').'|min:'.config('constant.password_min_length');
            // $validator['confirm_email'] = 'required|same:email|max:'.config('constant.email_length');
        }
        return $validator;
    }
}