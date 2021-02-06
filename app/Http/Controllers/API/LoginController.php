<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use App\Models\UserDeviceToken;
use App\Models\oAuthAccessTokens;

class LoginController extends BaseController
{
    public $successStatus = 200;
    protected $user;
    protected $userDeviceToken;
    protected $oAuthAccessTokens;

    /**
     * -------------------------------------------------------
     * | Create a new controller instance.                   |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function __construct(User $user, UserDeviceToken $userDeviceToken, oAuthAccessTokens $oAuthAccessTokens)
    {
        parent::__construct();
        $this->user = $user;
        $this->userDeviceToken = $userDeviceToken;
        $this->oAuthAccessTokens = $oAuthAccessTokens;
        $this->fillableCols = ['id','first_name', 'last_name', 'email', 'phone','user_type'];
    }

    /**
     * -------------------------------------------------------
     * | Login function.                                     |
     * |                                                     |
     * | @param  object/array $request                       |
     * | @return response                                    |
     * -------------------------------------------------------
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [ 'email' => 'required|email', 'password' => 'required', 'device_id' => 'required', 'fcm_token' => 'required', 'device_type' => 'required' ]);
        $email = strtolower(trim($request->email));
        if ($validator->fails()) {
            return $this->getResponse($this->blankObject,false,400,$validator->errors()->first());
        } else {
            $userObj = $this->user->where('email', '=', $email)->first(); /** Check email in database */
            if (isset($userObj)) {
                $userStatusCode = isset($userObj->status) ? $userObj->status : Null;
                if (\Hash::check($request->password, $userObj->password)) { /** Auth attempt code start */
                    $oAuthAccessTokensObj = $this->oAuthAccessTokens->where('user_id', '=', $userObj->id)->where('name', '=', config('constant.oAuthAccessTokensName'))->get(); /** Check weather the user is logged in or not */
                    if (count($oAuthAccessTokensObj) > 0) {
                        return $this->getResponse($this->blankObject,false,402,__('api_messages.login.already_login'));
                    }  else {
                        if ( $userObj->status == 0 ) {
                            return $this->getResponse($this->blankObject,false,400,__('api_messages.login.account_closed_or_suspended'));
                        } else if ( $userObj->email_verified_at == null ) {
                            return $this->getResponse($this->blankObject,false,400,__('api_messages.login.please_verify_acc'));
                        } else if ( $userObj->is_verify == config('constant.profile_review.under_review') ) { /** Account is not reviewed yet */
                            return $this->getResponse($this->blankObject,false,400,__('api_messages.login.profile_under_review'));
                        } else if( $userObj->is_verify == config('constant.profile_review.declined') ) { /** Account is declined by admin */
                            return $this->getResponse($this->blankObject,false,400,__('api_messages.login.profile_declined'));
                        } else {
                            $userArr = $this->getUserResponse($request,$userObj); /** User response code*/
                            return $this->getResponse($userArr,true,200, __('api_messages.login.login_success') ,$userObj->createToken(config('constant.oAuthAccessTokensName'))->accessToken);
                        }
                    }
                } else {
                    return  $userStatusCode == Null && $userStatusCode == config('constant.status_inactive_value') ? $this->getResponse($this->blankObject,false,400,__('api_messages.login.account_closed_or_suspended')) : $this->getResponse($this->blankObject,false,400,__('api_messages.login.invalid_username_password'));
                }
            } else {
                return $this->getResponse($this->blankObject,false,400,__('api_messages.login.invalid_username_password'));
            }
        }
    }

    /**
     * -------------------------------------------------------
     * | Logout function.                                    |
     * |                                                     |
     * | @param  object/array $request                       |
     * | @return response                                    |
     * -------------------------------------------------------
     */
    public function logout(Request $request)
    {
        if (isset($request->fcm_token) && !empty($request->fcm_token)) { /** Remove fcm_token code start */
            $userData = $this->userDeviceToken::where('fcm_token', 'LIKE', '%'.$request->fcm_token.'%')->first();
            if (isset($userData)) {
                $token = @$request->user()->tokens;
                if ($token != "") {
                    $token->find($userData->user_id);
                    $token->revoke();
                } else {
                    $authData = $this->oAuthAccessTokens->where('user_id', '=', $userData->user_id)->where('name', '=', config('constant.oAuthAccessTokensName'))->first();
                    $authData->delete();  /** Logout the user from previous device */
                }
                $userData->forceDelete(); /** Delete previous device fcm token */
            }
        }
        return $this->getResponse($this->blankObject,true,200,__('api_messages.login.logout_msg'));
    }


    /**
     * -------------------------------------------------------
     * | Get User response                                   |
     * |                                                     |
     * | @param  object/array $request                       |
     * | @return response                                    |
     * -------------------------------------------------------
     */
    public function getUserResponse($request,$userObj)
    {
        $userArr = replace_key($userObj->only($this->fillableCols), 'id' , 'user_id'); /** Used to replace key name in array */
        $userArr['profile_pic'] = $userObj->profile_image;
        $userArr['position']['position_id'] = $userObj->user_type;
        $userArr['position']['position_name'] = config("constant.user_types")[$userObj->user_type];
        $userArr['company']['company_id'] = $userObj->company->id;
        $userArr['company']['company_name'] = $userObj->company->title;
        $this->userDeviceTokens($userObj, $request); /** Insert fcm token & device type code*/
        /** Firebase response code start */
        $userArr['firebase_credential']['firebase_email'] = count($userObj->firebaseCredential) > 0 ? $userObj->firebaseCredential[0]->username : "";
        $userArr['firebase_credential']['firebase_password'] = count($userObj->firebaseCredential) > 0 ? isset($userObj->firebaseCredential[0]->password) ? $userObj->firebaseCredential[0]->password : "" : "";
        $userArr['firebase_credential']['firebase_uid'] = count($userObj->firebaseCredential) > 0 ? isset($userObj->firebaseCredential[0]->uid) ? $userObj->firebaseCredential[0]->uid : "" : "";
        /** Firebase response code end */
        $removedNullArr = removeNullFromArray($userArr); /** To remove null value from array */
        return $removedNullArr;
    }
}