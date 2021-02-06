<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SubCategoryFormRequest extends FormRequest
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
            'name' => ['required','max:30'],
            'parent_id' => 'required',
        ];
        if ($request->has('id') && $request->id != null) {
            $validator['name'][] = 'unique:subcategories,name,' . $request->id;
        } else {
            $validator['name'][] = 'unique:subcategories,name';
        }
        return $validator;
    }
}
