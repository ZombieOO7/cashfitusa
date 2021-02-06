<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class ProfileFromRequest extends FormRequest
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
            'first_name' => 'required|max:'.config('constant.name_length'),
            'last_name' => 'required|max:'.config('constant.name_length'),
            'middle_name' => 'required|max:'.config('constant.name_length'),
            'phone' =>'required|max:'.config('constant.max_phone_length'),
        ];
        return $validator;
    }
}
