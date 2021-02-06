<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingFormRequest;
use App\Models\WebSetting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public $constant, $activetab;

    public function index(Request $request)
    {
        $settings = [];
        $settings = WebSetting::first();        
        return view('admin.setting.index', ['webSettings'=>$settings]);
    }
    public function store(SettingFormRequest $request, $id = null)
    {
        try {
            $currentPath = Route::currentRouteName();
            $settings = WebSetting::firstOrNew(['id' => $request->id]);

            if ($request->hasFile('web_logos')) {
                $logo = $request->file('web_logos');
                $request['logo'] = $this->fileupload($logo, ($settings->logo) ? $settings->logo : null);
            }
            if ($request->hasFile('work_video')) {
                $video = $request->file('work_video');
                $request['video'] = $this->fileupload($video, ($settings->video) ? $settings->video : null);
            }
            $settings->fill($request->all())->save();

            // $env_update = $this->changeEnv([
            //     'APP_NAME' => $request->get('app_name'),
            //     'MAIL_FROM_ADDRESS' => $request->get('email'),
            // ]);
            // if ($env_update) {
            //     \Artisan::call('config:clear');
            // }

            $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.updated'), 'type' => 'Settings']);
            return Redirect::route('web_setting_index')->with(['message'=>@$msg,'active_tab'=>@$request->active_tab]);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function socialStore(Request $request, $id = null)
    {
        try {
            $currentPath = Route::currentRouteName();
            if($request->id){
                $settings = WebSetting::find($request->id);
            }else{
                $settings = New WebSetting();
            }
            $settings->fill($request->all())->save();

            // $env_update = $this->changeEnv([
            //     'APP_NAME' => $request->get('app_name'),
            //     'MAIL_FROM_ADDRESS' => $request->get('email'),
            // ]);
            // if ($env_update) {
            //     \Artisan::call('config:clear');
            // }

            $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.updated'), 'type' => 'Settings']);
            return Redirect::route('web_setting_index')->with(['message'=>@$msg,'active_tab'=>@$request->active_tab]);
        } catch (Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function fileupload($file, $name = null)
    {
        if ($name != null) {
            Storage::disk('local')->delete('websetting/' . $name);
        }
        $filename = time() . '_' . $file->getClientOriginalName();
        Storage::disk('local')->putFileAs('websetting/', $file, $filename);
        return $filename;
    }

    protected function changeEnv($data = array())
    {
        if (count($data) > 0) {

            // Read .env-file
            $env = file_get_contents(base_path() . '/.env');

            // Split string on every " " and write into array
            $env = preg_split('/\s+/', $env);

            // Loop through given data
            foreach ((array) $data as $key => $value) {

                // Loop through .env-data
                foreach ($env as $env_key => $env_value) {

                    // Turn the value into an array and stop after the first split
                    // So it's not possible to split e.g. the App-Key by accident
                    $entry = explode("=", $env_value, 2);

                    // Check, if new key fits the actual .env-key
                    if ($entry[0] == $key) {
                        // If yes, overwrite it with the new one
                        $env[$env_key] = $key . "=" . $value;
                    } else {
                        // If not, keep the old one
                        $env[$env_key] = $env_value;
                    }
                }
            }

            // Turn the array back to an String
            $env = implode("\n", $env);

            // And overwrite the .env with the new data
            file_put_contents(base_path() . '/.env', $env);
            // file_put_contents(base_path() . '/.env.example.qa', $env);
            // file_put_contents(base_path() . '/.env.example.stage', $env);
            return true;
        } else {
            return false;
        }
    }
}
