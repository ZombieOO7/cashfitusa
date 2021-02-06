<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Validation\Rule;
use Hash;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use App\Models\Company;
use App\Models\Machine;
use App\Models\Location;
use App\Models\Problem;
use App\Models\Faq;
use App\Models\User;
use App\Models\Notification;
use App\Models\UserNotification;


class MasterController extends BaseController
{
    public $successStatus = 200;
    protected $company;
    protected $machine;
    protected $location;
    protected $problem;
    protected $faq;
    protected $user;
    protected $notification;

    /**
     * -------------------------------------------------------
     * | Create a new controller instance.                   |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function __construct(Company $company,Machine $machine,Problem $problem,Location $location,Faq $faq,User $user,Notification $notification,UserNotification $userNotification)
    {
        parent::__construct();
        $this->company = $company;
        $this->machine = $machine;
        $this->location = $location;
        $this->problem = $problem;
        $this->faq = $faq;
        $this->user = $user;
        $this->notification = $notification;
        $this->userNotification = $userNotification;
    }

    /**
     * -------------------------------------------------------
     * | Machines List.                                      |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function machinesList() 
    {
        return $this->commanList($this->machine,'machine_id','machine_name','machines_list',__('api_messages.machines'));
    }

    /**
     * -------------------------------------------------------
     * | Locations List.                                     |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function locationsList() 
    {
        return $this->commanList($this->location,'location_id','location_name','locations_list',__('api_messages.locations'));
    }

    /**
     * -------------------------------------------------------
     * | Companies List.                                     |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function companiesList() 
    {
        return $this->commanList($this->company,'company_id','company_name','companies_list',__('api_messages.companies'));
    }

    /**
     * -------------------------------------------------------
     * | Problems List.                                      |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function problemsList() 
    {
        return $this->commanList($this->problem,'problem_id','problem_name','problems_list',__('api_messages.problems'));
    }

    /**
     * -------------------------------------------------------
     * | Comman For All List.                                |
     * |                                                     |
     * | @param $model,$newId,$title,$listTitle,$type        |
     * | @return Response                                    |
     * -------------------------------------------------------
     */
    public function commanList($model,$newId,$title,$listTitle,$type) 
    {
        $modelObj = $model::whereStatus(config('constant.status_active_value'))->whereNull('deleted_at')->select('id as '.$newId,'title as '.$title)->get();
        $list[$listTitle] = $modelObj;
        return count($modelObj) ? $this->getResponse($list,true,200,__('api_messages.list',['type' => $type])) : $this->getResponse($this->blankObject,false,405,__('api_messages.master.not_found',['type' => $type]));
    }

    /**
     * -------------------------------------------------------
     * | FAQs List.                                          |
     * |                                                     |
     * | @param Request $request                             |
     * | @return Response                                    |
     * -------------------------------------------------------
     */
    public function faqsList(Request $request) 
    {
        $validator = Validator::make($request->all(), [ 'page_number' => 'required|integer|min:1' ]); /** Validation code */
        if ($validator->fails()) {
            return $this->getResponse($this->blankObject,false,400,$validator->errors()->first());
        } else {
            $currentPage = trim($request->page_number); // You can set this to any page you want to paginate to

            // Make sure that you call the static method currentPageResolver() before querying users
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });

            $faqObjData = $this->faq::whereStatus(config('constant.status_active_value'))->whereNull('deleted_at')->orderBy('created_at', 'DESC');
            $faqObj = $faqObjData->paginate(config('constant.faq_page_limit')); /** Pagination */
            $jobResults = $faqObj->toArray();
            $faqFinalArr = [];

            foreach ($faqObj as $faqObjKey => $faqObjVal) { /** Used to display all faq */
                $faqArr['faq_id'] = $faqObjVal->id;
                $faqArr['title'] = $faqObjVal->title;
                $faqArr['description'] = $faqObjVal->content;
                $removedNullArr = removeNullFromArray($faqArr); /** To remove null value from array */
                array_push($faqFinalArr, $removedNullArr);
            }

            $faqArre['faqs_list'] = $faqFinalArr;
            $lastPage = $faqObj->lastPage(); /** Last page of record */
            if ($currentPage > $lastPage) { /** Check if this is last page or not */
                return $this->getResponse($this->blankObject,false,405,__('api_messages.no_records_found'),'',$faqObj,$lastPage);
            } else {
                return count($faqFinalArr) > 0 ? $this->getResponse($faqArre,true,200,__('api_messages.list',['type' => __('api_messages.faq')]),'',$faqObj,$lastPage) : $this->getResponse($this->blankObject,false,405,__('api_messages.no_records_found'),'',$faqObj,$lastPage);
            }
        }
    }

    /**
     * -------------------------------------------------------
     * | Engineers List.                                     |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function engineersList() 
    {
        $listArr = $this->user::whereUserType(config('constant.engineer'))->whereStatus(1)->whereNull('deleted_at')->whereNotNull('email_verified_at')->get();
        $engFinalArr = [];
        foreach ($listArr as $key => $value) { /** Used to display all engineer */
            $arr['engineer_id'] = $value->id;
            $arr['engineer_name'] = $value->full_name;
            $removedNullArr = removeNullFromArray($arr); /** To remove null value from array */
            array_push($engFinalArr, $removedNullArr);
        }
        $list['engineers_list'] = $engFinalArr;
        return count($listArr) ? $this->getResponse($list,true,200,__('api_messages.list',['type' => __('api_messages.engineers')])) : $this->getResponse($this->blankObject,false,405,__('api_messages.master.no_engineers_found'));
    }

    /**
     * -------------------------------------------------------
     * | Positions List.                                     |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function positionsList() 
    {
        $modelObj = config('constant.user_types');
        $positionFinalArr = [];
        foreach ($modelObj as $key => $val) { /** Used to display all engineer */
            $arr['position_id'] = $key;
            $arr['position_name'] = $val;
            $removedNullArr = removeNullFromArray($arr); /** To remove null value from array */
            array_push($positionFinalArr, $removedNullArr);
        }
        $list['positions_list'] = $positionFinalArr;
        return count($modelObj) ? $this->getResponse($list,true,200,__('api_messages.list',['type' => __('api_messages.positions')])) : $this->getResponse($this->blankObject,false,405,__('api_messages.master.not_found',['type' => __('api_messages.positions')]));
    }

    /**
     * -------------------------------------------------------
     * | Notifications List.                                 |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function notificationList(Request $request) 
    {
        $validator = Validator::make($request->all(), [ 'page_number' => 'required|integer|min:1' ]); /** Validation code */
        if ( $validator->fails() ) {
            return $this->getResponse($this->blankObject,false,400,$validator->errors()->first());
        } else {
            $currentPage = trim($request->page_number); // You can set this to any page you want to paginate to

            // Make sure that you call the static method currentPageResolver() before querying users
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });

            $tokenUserId = $request->user()->token()->user_id;
            $notificationObjData = $this->userNotification::whereUserId($tokenUserId)->orderBy('created_at', 'DESC');
            $notificationObj = $notificationObjData->paginate(config('constant.faq_page_limit')); /** Pagination */
            $jobResults = $notificationObj->toArray();
            $notificationFinalArr = [];

            foreach ($notificationObj as $notificationObjKey => $notificationObjVal) { /** Used to display all faq */
                $faqArr['content'] = $notificationObjVal->description;
                $faqArr['date_time'] = timeStampConverter($notificationObjVal->created_at);
                $removedNullArr = removeNullFromArray($faqArr); /** To remove null value from array */
                array_push($notificationFinalArr, $removedNullArr);
            }

            $notificationArre['notification_list'] = $notificationFinalArr;
            $lastPage = $notificationObj->lastPage(); /** Last page of record */
            if ($currentPage > $lastPage) { /** Check if this is last page or not */
                return $this->getResponse($this->blankObject,false,405,__('api_messages.no_records_found'),'',$notificationObj,$lastPage);
            } else {
                return count($notificationFinalArr) > 0 ? $this->getResponse($notificationArre,true,200,__('api_messages.list',['type' => __('api_messages.notifications')]),'',$notificationObj,$lastPage) : $this->getResponse($this->blankObject,false,405,__('api_messages.no_records_found'),'',$notificationObj,$lastPage);
            }
        }
    }
}