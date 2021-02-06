<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Validator;
use App\Models\User;
use Hash;
use App\Models\EmailTemplate;


class ResetPasswordController extends BaseController
{
    public $successStatus = 200;
    protected $user;
    protected $emailTemplate;

    /**
     * -------------------------------------------------------
     * | Create a new controller instance.                   |
     * |                                                     |
     * -------------------------------------------------------
    */
    public function __construct(User $user, EmailTemplate $emailTemplate)
    {
        parent::__construct();
        $this->middleware('guest');
        $this->user = $user;
        $this->emailTemplate = $emailTemplate;
    }


    /**
     * -------------------------------------------------------
     * | Forget Password                                     |
     * |                                                     |
     * | @param $request                                     |
     * | @return Response                                    |
     * -------------------------------------------------------
     */
    public function forgotPassword(Request $request)
    {
        $email = strtolower($request->email);
        $rules =  [
            'email' => 'required|email',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
           return $this->getResponse($this->blankObject,false,400,$validator->errors()->first()); /** Display data to frontend code. */
        } else {
            //check user status active or inactive
            $userData = $this->user->where('email', '=', $email)->first();
            if ($userData) {
                $password = mt_rand(100000, 999999);
                $data['otp'] = $password;
                //** This is for email sending start*/
                $emailDataObj = $this->emailTemplate::where('id', 7)->whereStatus('1')->first();
                if (isset($emailDataObj)) {
                    $emailData = [
                        'display_name' => $userData->full_name,
                        'password' => $password,
                        'body' =>  $emailDataObj->body,
                    ];
                    $subject =  $emailDataObj->subject;
                    $file = 'email.password_send';
                    $this->singleUserEmailNotifiaction($emailData, $subject, $userData ,$file);
                }
                //** This is for email sending end*/
                return $this->getResponse($data,true,200,__('api_messages.forget_password.check_your_mail'));
            } else {
                return $this->getResponse($this->blankObject,false,400,__('api_messages.forget_password.credentials_do_not_match'));
            }
        }
        return response()->json($data, $this->successStatus);
    }
}