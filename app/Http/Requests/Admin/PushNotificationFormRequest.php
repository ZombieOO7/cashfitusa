<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PushNotificationFormRequest extends FormRequest
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
            'title' => ['required'],
            'body' => 'required',
        ];
        if ($request->has('id') && $request->id != null) {
            $validator['title'][] = 'unique:push_notifications,title,' . $request->id;
        } else {
            $validator['title'][] = 'unique:push_notifications,title';
        }
        return $validator;
    }
}