<?php
namespace App\Helpers;

use App\Models\Admin;
use App\Models\EmailTemplate;
use App\Models\LoanNotification;
use App\Models\WebSetting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BaseHelper
{
    public $mode,$emailTemplate;
    public function __construct()
    {

    }
    /**
     * -------------------------------------------------------------
     * | DB transation start                                       |
     * |                                                           |
     * | @return Void                                              |
     * -------------------------------------------------------------
     */
    public function dbStart()
    {
        DB::beginTransaction();
    }

    /**
     * -------------------------------------------------------------
     * | DB transation end                                         |
     * |                                                           |
     * | @return Void                                              |
     * -------------------------------------------------------------
     */

    public function dbEnd()
    {
        DB::commit();
    }

    /**
     * -------------------------------------------------------------
     * | DB transation roll back                                   |
     * |                                                           |
     * | @return Void                                              |
     * -------------------------------------------------------------
     */
    public function dbRollBack()
    {
        DB::rollback();
    }
    /**
     * -------------------------------------------------------------
     * | Delete image                                              |
     * |                                                           |
     * | @param $imageName,$viewFolderName                         |
     * | @return Void                                              |
     * -------------------------------------------------------------
     */
    public function deleteImage($imageName, $viewFolderName)
    {
        $path = base_path($imageName);
        // $path = str_replace('public', '', $path);
        if (File::exists($path)) {
            File::delete($path);
        }
    }

    /**
     * -------------------------------------------------------
     * | Upload Image Code                                   |
     * |                                                     |
     * | @param  string $mainFolderName                      |
     * | @param  string $folderName                          |
     * | @param  string $image                               |
     * | @return string                                      |
     * -------------------------------------------------------
     */
    public function uploadImage($file,$folderName,$width=null,$height=null)
    {
        $image = $file;
        $fileName   = time() . '.' . $image->getClientOriginalExtension();
        $newFileName = Storage::disk('local')->put($folderName, $image, 'public');
        $fileName = pathinfo($newFileName, PATHINFO_FILENAME) . '.' . pathinfo($newFileName, PATHINFO_EXTENSION);
        return $fileName;
    }

    /**
     * ------------------------------------------------------
     * | Send Mail to user                                  |
     * |                                                    |
     * |-----------------------------------------------------
     */
    public function sendMail($view, $data, $message = null, $subject, $userdata)
    {
        $setting = getWebSetting();
        if($setting && $setting->send_email == 1){
            Mail::send($view, $data, function ($message) use ($userdata, $subject) {
                $message->to($userdata->email)->subject($subject);
            });
        }
    }

    /**
     * ------------------------------------------------------
     * | Send Bulk Mail to users                            |
     * |                                                    |
     * |-----------------------------------------------------
     */
    public function bulkSendMail($view, $data, $message = null, $subject, $userdata, $emails){
        Mail::send($view, $data, function($message) use ($userdata,$emails,$subject)
        {
            $message->to($emails)->subject($subject);
        });
    }
    /**
     * -------------------------------------------------------
     * | Get email template data                             |
     * |                                                     |
     * | @return array                                       |
     * -------------------------------------------------------
     */
    public function getTemplate($slug){
        $template = EmailTemplate::whereSlug($slug)->first();
        return @$template;
    }


    /**
     * ------------------------------------------------------
     * | Store image                                        |
     * |                                                    |
     * | @param $request,$user                              |
     * |-----------------------------------------------------
     */
    public function storeImage($request, $data,$folderName,$columnName,$file)
    {
        if ($request->id != null):
            $this->deleteImage($data->path, $folderName);
            $this->deleteImage($data->thumb_path, $folderName);
        endif;
        $avatarImage = $file;
        $imageFunction = $this->uploadImage($file, $folderName,240,320);
        $data = $data::updateOrCreate([
            'id' => $data->id,
        ], [
            $columnName => @$imageFunction,
        ]);
        return $request;
    }
    public function sendNotification($data,$status,$type){
        $notification = new LoanNotification();
        $detail['type'] =$type;
        $detail['user_id']=$data->user_id;
        if($type == 1){
            $detail['content']= 'your loan application of '. config('constant.currency_symbol').$data->loan_amount .' has been '.strtolower($status);
            $detail['loan_detail_id'] = $data->id;
        }elseif($type == 2){
            $detail['earning_id'] = $data->id;
            $detail['app_id'] = $data->app_id;
            $detail['content']= 'your '.@$data->app->title_text.' app work request has been '.strtolower($status);
        }elseif($type == 3){
            $detail['user_earning_id'] = $data->id;
            $detail['user_id'] = $data->earningUser->user_id;
            $detail['app_id'] = $data->app_id;
            $detail['content']= $status;
            $detail['type'] =2;
        }else{
            $detail['earning_id'] = @$data->earning_id;
            $detail['user_id']=$data->earningUser->user_id;
            $detail['app_id'] = @$data->app_id;
            $detail['content']= 'your '.@$data->app->title_text.' app with withdraw request has been '.strtolower($status);
            $detail['type'] =2;
        }
        $notification->create($detail);
    }

    public function sendMultipleNotification($datas,$status,$type){
        foreach($datas as $key => $data){
            $notification = new LoanNotification();
            $detail['type'] =$type;
            $detail['user_id']=$data->user_id;
            if($type == 1){
                $detail['content']= 'your loan application of '. config('constant.currency_symbol').$data->loan_amount .' has been '.strtolower($status);
                $detail['loan_detail_id'] = $data->id;
            }elseif($type == 2){
                $detail['earning_id'] = $data->id;
                $detail['app_id'] = $data->app_id;
                $detail['content']= 'your '.@$data->app->title_text.' app work request has been '.strtolower($status);
            }else{
                $detail['earning_id'] = @$data->earning_id;
                $detail['user_id']=$data->earningUser->user_id;
                $detail['app_id'] = @$data->app_id;
                $detail['content']= 'your '.@$data->app->title_text.' app with withdraw request has been '.strtolower($status);
                $detail['type'] =2;
            }
            $notification->create($detail);
        }
    }

    /**
     * ------------------------------------------------------
     * | Send Mail to user                                  |
     * |                                                    |
     * |-----------------------------------------------------
     */
    public function sendMailToAdmin($templateSlug,$view, $userObj, $message = null,$objectData=null)
    {
        $emailObjData = EmailTemplate::whereSlug(config('constant.mail_template.1'))->first();
        if (isset($emailObjData)) {
            $emailData = [ 'email' => @$userObj->email,'display_name' => @$userObj->full_name , 'content' => @$emailObjData->content,'body'=>@$emailObjData->body,'objectData'=>@$objectData];
            $subject = $emailObjData->subject;
            $emails = Admin::where('status',1)->pluck('email')->toArray();
            Mail::send($view, $emailData, function($message) use ($emails,$subject)
            {
                $message->to($emails)->subject($subject);
            });
        }
    }
}
