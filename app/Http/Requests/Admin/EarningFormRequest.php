<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class EarningFormRequest extends FormRequest
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
            'first_name' => ['required','max:'.config('constant.name_length')],
            'middle_name' => ['required','max:'.config('constant.name_length')],
            'last_name' => ['required','max:'.config('constant.name_length')],
            'dob' => ['required'],
            'address1' =>['required'],
            // 'address2' =>['required'],
            'city' =>['required'],
            'state' =>['required'],
            'zip_code' =>['required'],
            'status' =>['required'],
            'app_id' =>['required'],
            'user_id' =>['required'],
            'front_licence' => ['sometimes'],
            'address_proof' =>['sometimes'],
        ];
        if($request->hasFile('front_licence')){
            $validator['front_licence'][] = 'max:2048';
        }
        if($request->hasFile('address_proof')){
            $validator['address_proof'] = 'max:2048';
        }
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
