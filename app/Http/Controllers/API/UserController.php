<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Validator;
use Illuminate\Validation\Rule;
use Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserSupport;
use App\Models\ContactUs;
use Exception;

class UserController extends BaseController
{
    public $successStatus = 200;
    protected $user;
    protected $userSupport;
    protected $contactUs;

    /**
     * -------------------------------------------------------
     * | Create a new controller instance.                   |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function __construct(User $user,ContactUs $contactUs,UserSupport $userSupport)
    {
        parent::__construct();
        $this->user = $user;
        $this->userSupport = $userSupport;
        $this->contactUs = $contactUs;
        $this->fillableCols = ['id','first_name', 'last_name', 'email', 'phone'];
    }

    /**
     * -------------------------------------------------------
     * | Set a new User Password                             |
     * |                                                     |
     * | @param $request                                     |
     * | @return Response                                    |
     * -------------------------------------------------------
     */
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [ 'old_password' => 'required', 'new_password' => 'different:old_password|required_with:confirm_password|same:confirm_password','confirm_password' => 'required' ]); /** Validation code */
        if ($validator->fails()) {
            return $this->getResponse($this->blankObject,false,400,$validator->errors()->first());
        } else {
            $tokenUserId = $request->user()->token()->user_id;
            $userObj = $this->user::whereId($tokenUserId)->first();
            if (Hash::check($request->old_password, @$userObj->password)) { 
                $userObj->password = Hash::make($request->get('new_password')); /** Set new password */
                $userObj->save();
                return $this->getResponse($this->blankObject,true,200,__('api_messages.user.password_changed'));
            } else {
                return $this->getResponse($this->blankObject,false,400,'Old password do not match with our records!');
            }
        }
    }

    /**
     * -------------------------------------------------------
     * | Contact Us                                          |
     * |                                                     |
     * | @param $request                                     |
     * | @return Response                                    |
     * -------------------------------------------------------
     */
    public function contactUs(Request $request)
    {
        $validator = Validator::make($request->all(), [ 'email' => 'required', 'full_name' => 'required', 'phone' => 'required', 'message' => 'required']); /** Validation code */
        $tokenUserId = $request->user()->token()->user_id; /** Auth id */
        array_set($request,'user_id',$tokenUserId);
        $this->sendNotificationToAdmin($tokenUserId,'Contact us request received');/** Notifiy Admin */
        return $validator->fails() ? $this->getResponse($this->blankObject,false,400,$validator->errors()->first()) : $this->getResponse($this->contactUs::create($request->all()),true,200,'Contact us details submitted successfully.');
    }

    /**
     * -------------------------------------------------------
     * | Support                                             |
     * |                                                     |
     * | @param $request                                     |
     * | @return Response                                    |
     * -------------------------------------------------------
     */
    public function support(Request $request)
    {
        $validator = Validator::make($request->all(), [ 'email' => 'required', 'message' => 'required']); /** Validation code */
        $tokenUserId = $request->user()->token()->user_id; /** Auth id */
        array_set($request,'user_id',$tokenUserId);
        return $validator->fails() ? $this->getResponse($this->blankObject,false,400,$validator->errors()->first()) : $this->getResponse($this->userSupport::create($request->all()),true,200,'Your details submitted successfully.');
    }

    /**
     * -------------------------------------------------------
     * | User Profile Detail                                 |
     * |                                                     |
     * | @param $request                                     |
     * | @return Response                                    |
     * -------------------------------------------------------
     */
    public function profileDetail(Request $request)
    {
        $query = $this->user::whereNotNull('email_verified_at')->whereStatus(1)->whereIsVerify(1);
        if (isset($request->engineer_id) && $request->engineer_id != null) {
            $userObj = $query->whereId($request->engineer_id)->first();
            if ( isset($userObj) ) {
                $userArr = $this->userResponse($userObj, 'profile'); /** Response code */
                $response = $this->getResponse($userArr,true,200,__('api_messages.user.profile_detail'));
            } else {
                $response = $this->getResponse($this->blankObject,false,405,__('api_messages.no_records_found'));
            }
        } else {
            $tokenUserId = $request->user()->token()->user_id; /** Auth id */
            $userObj = $query->whereId($tokenUserId)->first(); /** User object list */
            if ( isset($userObj) ) {
                $userArr = $this->userResponse($userObj, 'profile'); /** Response code */
                $response = $this->getResponse($userArr,true,200,__('api_messages.user.profile_detail'));
            } else {
                $response = $this->getResponse($this->blankObject,false,405,__('api_messages.no_records_found'));
            }
        }
        return $response;
    }

    /**
     * -------------------------------------------------------
     * | Update Profile Detail                               |
     * |                                                     |
     * | @param $request                                     |
     * | @return Response                                    |
     * -------------------------------------------------------
     */
    public function updateProfile(Request $request) 
    {
        $tokenUserId = $request->user()->token()->user_id; /** Auth id */
        $rules = [
            'profile_pic' => 'image|mimes:jpeg,png,jpg',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,'.$tokenUserId.',id,deleted_at,NULL',
            'phone' => 'required',
            'company_id' => 'required|exists:companies,id',
            'position_id' => 'required',
        ]; /** Validation code */

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return  $this->getResponse($this->blankObject,false,400,$validator->errors()->first());
        } else {
            $userObj = $this->user::whereId($tokenUserId)->whereNotNull('email_verified_at')->whereStatus(1)->whereIsVerify(1)->first();
            if ($userObj) {
                $this->dbStart();
                try {
                    if ($request->profile_pic && $request->profile_pic != null) {  
                        $profilePic = $request->file('profile_pic');
                        if (isset($profilePic) && !empty($profilePic)) {
                            $image_path = public_path('uploads/users/') . $userObj->profile_pic;
                            if(file_exists($image_path) && isset($userObj->profile_pic)) {
                                unlink($image_path);
                            }
                            $profileImag =  $this->uploadImage('uploads', 'users', $profilePic);
                            $userObj->profile_pic = $profileImag;
                        } else {
                            $userObj->profile_pic = $userObj->profile_pic;
                        }
                    }
                    $userObj->user_type = $request->position_id;
                    $userObj->save();
                    $userObj = $userObj->refresh();
                    $userArr = $this->userResponse($userObj, 'detail');/** Response here */
                    $this->dbCommit();
                    return $this->getResponse($userArr,true,200,__('api_messages.user.your_profile_updated'));
                } catch (Exception $e) {
                    $this->dbEnd();
                    return $this->getResponse($jobObj,false,400, __('api_messages.somthing_went_wrong'));
                }
            } else {
                return $this->getResponse($this->blankObject,false,405,__('api_messages.no_records_found'));
            }
        }
    }

    /**
     * -------------------------------------------------------
     * | User  response                                      |
     * |                                                     |
     * | @param $request                                     |
     * | @return Response                                    |
     * -------------------------------------------------------
     */
    public function userResponse($userObj, $type)
    {
        $userArr = replace_key($userObj->only($this->fillableCols), 'id' , 'user_id'); /** Rename the key name */
        $userArr['profile_pic'] = $userObj->profile_image;
        $userArr['position']['position_id'] = $userObj->id;
        $userArr['position']['position_name'] = config("constant.user_types")[$userObj->user_type];
        $userArr['company']['company_id'] = $userObj->company->id;
        $userArr['company']['company_name'] = $userObj->company->title;
        /** Firebase data code start */
        $userArr['firebase_credential']['firebase_email'] = count($userObj->firebaseCredential) > 0 ? isset($userObj->firebaseCredential[0]->username) ? $userObj->firebaseCredential[0]->username : ""  : "";
        $userArr['firebase_credential']['firebase_password'] = count($userObj->firebaseCredential) > 0 ? isset($userObj->firebaseCredential[0]->password) ? $userObj->firebaseCredential[0]->password : "" : "";
        $userArr['firebase_credential']['firebase_uid'] = count($userObj->firebaseCredential) > 0 ? isset($userObj->firebaseCredential[0]->uid) ? $userObj->firebaseCredential[0]->uid : "" : "";
        /** Firebase data code end */
        $userArr = removeNullFromArray($userArr); /** Remove null value */
        return $userArr;
    }
    
}
?>