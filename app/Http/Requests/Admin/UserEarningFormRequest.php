<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserEarningFormRequest extends FormRequest
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
            'date' => ['required'],
            'status' =>['required'],
            'app_id' =>['required'],
            'earning_user_id' =>['required'],
            'amount' => ['required'],
            'status' =>['required'],
        ];
        return $validator;
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.unique'=>__('admin/messages.name',['type'=>'Company'])
        ];
    }
}
