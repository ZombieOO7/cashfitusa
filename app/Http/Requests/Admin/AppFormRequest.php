<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AppFormRequest extends FormRequest
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
            'title' => ['required','max:'.config('constant.name_length')],
            'description' =>['required','max:'.config('constant.content_length')],
            'status' =>['required'],
            'image_file' => ['sometimes'],
            // 'video_file' =>['sometimes'],
        ];
        if($request->hasFile('image_file')){
            $validator['image_file'][] = 'max:2048';
        }
        if($request->hasFile('video_file')){
            $validator['video_file'] = 'max:20480';
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
