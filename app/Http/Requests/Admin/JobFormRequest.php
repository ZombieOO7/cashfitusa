<?php

namespace App\Http\Requests\Admin;

use App\Models\Job;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JobFormRequest extends FormRequest
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
            'title' => ['required', 'max:' . config('constant.name_length')],
            'description' => 'required',
            'machine_id' => 'required|exists:machines,id',
            'location_id' => 'required|exists:locations,id',
            'problem_id' => 'required|exists:problems,id',
            'assigned_to' => 'required|exists:users,id',
            'priority' => 'required',
            'job_status_id' => 'required',
            'status' => 'required',
            'status' => 'required',
            'image' => [Rule::requiredIf(function () use ($request) {
                if($request->id != null){
                    $job = Job::whereId($request->id)->withCount(['jobImage'])->first();
                    if($job && $job->job_image_count > 0){
                        return false;
                    }else{
                        return true;
                    }
                }else{
                    return false;
                }
            })
        ,'max:5120']
        ];
        if ($request->has('id') && $request->id != null) {
            $validator['title'][] = 'unique:jobs,title,'.$request->id.',id,deleted_at,NULL';
        } else {
            $validator['title'][] = 'unique:jobs,title,NULL,id,deleted_at,NULL';
            $validator['image'] ='required|max:5120';
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
            'title.unique'=>__('admin/messages.title',['type'=>'Job'])
        ];
    }
}
