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
use App\Models\User;
use App\Models\Job;
use App\Models\JobImage;
use App\Models\JobLog;
use App\Events\UserNotificationEvent;

class JobController extends BaseController
{
    public $successStatus = 200;
    protected $machine;
    protected $location;
    protected $problem;
    protected $user;
    protected $job;
    protected $jobLog; 
    protected $jobImage;

    /**
     * -------------------------------------------------------
     * | Create a new controller instance.                   |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function __construct(Machine $machine,Problem $problem,Location $location,User $user,Job $job,JobImage $jobImage,JobLog $jobLog)
    {
        parent::__construct();
        $this->machine = $machine;
        $this->location = $location;
        $this->problem = $problem;
        $this->user = $user;
        $this->job = $job;
        $this->jobImage = $jobImage;
        $this->jobLog = $jobLog;
    }

    /**
     * -------------------------------------------------------
     * | Add new job.                                        |
     * |                                                     |
     * | @param Request $request                             |
     * | @return Response                                    |
     * -------------------------------------------------------
     */
    public function add(Request $request) 
    {
        $rules = [ 'title' => 'required|max:100|unique:jobs,title,NULL,id,deleted_at,NULL', 'machine_id' => 'required|exists:machines,id', 'location_id' => 'required|exists:locations,id', 'problem_id' => 'required|exists:problems,id', 'comment' => 'required','description' => 'required', 'image.*' => 'image|mimes:jpeg,png,jpg|max:5120' ];
        $messages = ['image.*.max' => config('constant.image_size_msg')];
        $validator = Validator::make($request->all(), $rules,$messages); /** Validation code */

        if ( $validator->fails() ) {
            return $this->getResponse($this->blankObject,false,400,$validator->errors()->first());
        } else {
            $tokenUserId = $request->user()->token()->user_id;
            array_set($request,'user_id',$tokenUserId);
            array_set($request,'job_status_id',1);
            $this->dbStart();
            try {
                $jobObj = $this->job::create($request->all());
                $jobObj['machine_id'] = (int) $jobObj->machine_id;
                $jobObj['problem_id'] = (int) $jobObj->problem_id;
                $jobObj['location_id'] = (int) $jobObj->location_id;
                $jobObj['job_id'] = $jobObj->id;
                /** Upload job images */
                $jobsImageArr = $request->file('image');
                $jobsFolder = 'jobs';
                $jobsImg = [];
                if (isset($jobsImageArr) && !empty($jobsImageArr)) {
                    foreach ($jobsImageArr as $jobsImage) {
                        $jobsImg = $this->uploadImage('uploads', $jobsFolder, $jobsImage);
                        $this->jobImage::create([ 'job_id' => $jobObj->id, 'image' => $jobsImg ]);
                    }
                }
                
                $jobObj['job_status'] = $jobObj->job_status_id;
                $jobId = $jobObj['id'];
                unset($jobObj['id']);
                unset($jobObj['job_status_id']);
                $user = $this->user::whereId($tokenUserId)->first();
                $url = 'job/detail/'.$jobObj['uuid'];
                $message = 'New job requested';
                $this->sendNotificationToAdmin($tokenUserId,$message,$jobId,$url); /*Notifiy Admin */

                /** Send new job request notification to managers starts here */
                $managersList = $this->user::where('id','<>',$tokenUserId)->whereUserType(1)->whereStatus(1)->whereNotNull('email_verified_at')->whereIsVerify(1)->whereNull('deleted_at')->get();
                if ($managersList->count() > 0) {
                    foreach ($managersList as $manager) {
                        event(new UserNotificationEvent($manager->id, $jobId, get_class($this->job), $message, 1)); /** Event activity record */
                    }
                }
                /** Send new job request notification to managers ends here */
                $job = Job::whereId($jobId)->first();
                $this->sendPushNotificationToMultiple($job,$managersList,'job_added','New job requested','Job requested');
                $this->dbCommit();
                return $this->getResponse($jobObj,true,200, __('api_messages.job.added_msg'));
            } catch (Exception $e) {
                $this->dbEnd();
                return $this->getResponse($jobObj,false,400, __('api_messages.somthing_went_wrong'));
            }
        }
    }

    /**
     * -------------------------------------------------------
     * | Edit job.                                           |
     * |                                                     |
     * | @param Request $request                             |
     * | @return Response                                    |
     * -------------------------------------------------------
     */
    public function edit(Request $request) 
    {
        $rules = [ 'job_id'=>'required|integer', 'title' => 'required|max:100,NULL', 'machine_id' => 'required|exists:machines,id', 'location_id' => 'required|exists:locations,id', 'problem_id' => 'required|exists:problems,id','description' => 'required', 'comment' => 'required|max:500', 'image.*' => 'image|mimes:jpeg,png,jpg|max:5120','priority' => 'required','engineer_id' => 'required' ]; /** Validation code */
        
        $messages = ['image.*.max' => __('api_messages.image_size_msg')];
        $validator = Validator::make($request->all(), $rules,$messages); /** Validation code */

        if ( $validator->fails() ) {
            return $this->getResponse($this->blankObject,false,400,$validator->errors()->first());
        } else {
            $tokenUserId = $request->user()->token()->user_id;
            $jobObjData = $this->job::whereId($request->job_id)->whereUserId($tokenUserId)->whereStatus(config('constant.status_active_value'))->whereNull('deleted_at')->first();
            if ($jobObjData) {
                $this->dbStart();
                try {
                    /** Upload job images */
                    $jobsImageArr = $request->file('image');
                    $jobsFolder = 'jobs';
                    $jobsImg = [];
                    if (isset($jobsImageArr) && !empty($jobsImageArr)) {
                        foreach ($jobObjData->jobImage as $imgObj) {
                            $image_path = public_path('uploads/jobs/') . $imgObj->image;
                            if(file_exists($image_path) && isset($imgObj->image)) {
                                unlink($image_path);
                            }
                        }
                        $jobObjData->jobImage()->forceDelete();
                        foreach ($jobsImageArr as $jobsImage) {
                            $jobsImg = $this->uploadImage('uploads', $jobsFolder, $jobsImage);
                            $this->jobImage::create([ 'job_id' => $jobObjData->id, 'image' => $jobsImg ]);
                        }
                    }
                    if ( $jobObjData->assigned_to != $request->engineer_id ) { /** Check if new engineer assigned or not */
                        $removedEngineer = $jobObjData->assigned_to;
                        $assignedEngineer = $request->engineer_id;
                        $message = 'Job reassigned to new engineer';

                        /** Reassign engineer send notification to reassigned engineer & removed engineer starts here */
                        event(new UserNotificationEvent($removedEngineer, $jobObjData->id, get_class($this->job), $message, 6)); /** Event activity record */
                        event(new UserNotificationEvent($assignedEngineer, $jobObjData->id, get_class($this->job), $message, 6)); /** Event activity record */

                        $this->sendPushNotificationToSingle($jobObjData,$removedEngineer,'engineer_reassigned','Job reassigned to new engineer','Engineer reassigned');
                        $this->sendPushNotificationToSingle($jobObjData,$assignedEngineer,'engineer_reassigned','Job reassigned to new engineer','Engineer reassigned');

                        /** Reassign engineer send notification to reassigned engineer & removed engineer ends here */

                        /** Reassign engineer send notification to operator starts here */
                        $usersList = $this->user::where('id','<>',$tokenUserId)->whereUserType(3)->whereStatus(1)->whereNotNull('email_verified_at')->whereIsVerify(1)->whereNull('deleted_at')->get();
                        if ($usersList->count() > 0) {
                            foreach ($usersList as $user) {
                                event(new UserNotificationEvent($user->id, $jobObjData->id, get_class($this->job), $message, 6)); /** Event activity record */
                            }
                            $this->sendPushNotificationToMultiple($jobObjData,$usersList,'engineer_reassigned','Job reassigned to new engineer','Engineer reassigned');
                        }
                        /** Reassign engineer send notification to operator ends here */   
                    }
                    $jobObjData->update($request->all());
                    unset($jobObjData['id']);
                    $this->dbCommit();
                    return $this->getResponse($this->blankObject,true,200, __('api_messages.job.job_updated_msg'));
                } catch (Exception $e) {
                    $this->dbEnd();
                    return $this->getResponse($jobObj,false,400, __('api_messages.somthing_went_wrong'));
                }
            } else {
                return $this->getResponse($this->blankObject,false,400,__('api_messages.job.job_not_found'));
            }
        }
    }

    /**
     * -------------------------------------------------------
     * | Job detail.                                         |
     * |                                                     |
     * | @param Request $request                             |
     * | @return Response                                    |   
     * -------------------------------------------------------
     */
    public function detail(Request $request) 
    {
        $validator = Validator::make($request->all(), [ 'job_id' => 'required|exists:jobs,id' ]); /** Validation code */
        if ( $validator->fails() ) {
            return $this->getResponse($this->blankObject,false,400,$validator->errors()->first());
        } else {
            $jobDetail = $this->job::whereId($request->job_id)->first();
            $jobArr['job_id'] = $jobDetail->id;
            $jobArr['title'] = $jobDetail->title;
            $jobArr['description'] = $jobDetail->description;
            $jobArr['job_status'] = $jobDetail->job_status_id;
            $jobArr['job_duration'] = @$jobDetail->total_job_duration != null ? $jobDetail->total_job_duration : "00:00:00";
            $jobArr['priority'] = $jobDetail->priority;
            $jobArr['images'] = $this->getJobImages($jobDetail);
            $jobArr['machine_name'] = $jobDetail->machine->title;
            $jobArr['location_of_problem'] = $jobDetail->location->title.' '.$jobDetail->problem->title;
            $jobArr['comment'] = $jobDetail->comment;
            $jobArr['engineer_id'] = @$jobDetail->assign ? $jobDetail->assign->id : '';
            $jobArr['start_date'] = date('Y-m-d H:i:s',strtotime($jobDetail->created_at));
            $removedNullArr = removeNullFromArray($jobArr); /** To remove null value from array */
            return $this->getResponse($removedNullArr,true,200,__('api_messages.job.job_details'));
        }
    }

    /**
     * -------------------------------------------------------
     * | All Job List.                                       |
     * |                                                     |
     * | @param Request $request                             |
     * | @return Response                                    |
     * -------------------------------------------------------
     */
    public function allJobs(Request $request) 
    {
        $validator = Validator::make($request->all(), [ 'page_number' => 'required|integer|min:1' ]); /** Validation code */
        if ( $validator->fails() ) {
            return $this->getResponse($this->blankObject,false,400,$validator->errors()->first());
        } else {
            if ( isset($request->engineer_id) && $request->engineer_id != null) {
                $tokenUserId = $request->engineer_id;
            } else {
                $tokenUserId = $request->user()->token()->user_id;
            }
            
            $loggedInUser = $this->user::whereId($tokenUserId)->first();

            $currentPage = trim($request->page_number); // You can set this to any page you want to paginate to

            // Make sure that you call the static method currentPageResolver() before querying users
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });

            $query = $this->job::whereStatus(config('constant.status_active_value'))->whereNull('deleted_at');
            if ( $loggedInUser->user_type == config('constant.manager') ) { /** Check if manager or not */
                $jobObjData = $query;
            } else if ( $loggedInUser->user_type == config('constant.engineer') ) {
                $jobObjData = $query->whereAssignedTo($tokenUserId);
            } else {
                $jobObjData = $query::whereUserId($tokenUserId);
            }
            
            $jobObjData = $query->orderBy('created_at', 'DESC');
            $jobObj = $jobObjData->paginate(config('constant.job_page_limit')); /** Pagination */
            $jobResults = $jobObj->toArray();
            $jobFinalArr = [];

            foreach ($jobObj as $jobObjKey => $jobObjVal) { /** Used to display all faq */
                $jobArr['job_id'] = $jobObjVal->id;
                $jobArr['title'] = $jobObjVal->title;
                $jobArr['description'] = $jobObjVal->description;
                $jobArr['job_status'] = $jobObjVal->job_status_id;
                $jobArr['priority'] = $jobObjVal->priority;
                $jobArr['images'] = $this->getIndexJobImage($jobObjVal);
                $jobArr['created_at'] = date('Y-m-d H:i:s',strtotime($jobObjVal->created_at));
                $removedNullArr = removeNullFromArray($jobArr); /** To remove null value from array */
                array_push($jobFinalArr, $removedNullArr);
            }

            $jobArre['all_jobs_list'] = $jobFinalArr;
            $lastPage = $jobObj->lastPage(); /** Last page of record */
            if ($currentPage > $lastPage) { /** Check if this is last page or not */
                return $this->getResponse($this->blankObject,false,405,__('api_messages.no_records_found'),'',$jobObj,$lastPage);
            } else {
                return count($jobFinalArr) > 0 ? $this->getResponse($jobArre,true,200,__('api_messages.job.all_jobs_list'),'',$jobObj,$lastPage) : $this->getResponse($this->blankObject,false,405,__('api_messages.no_records_found'),'',$jobObj,$lastPage);
            }
        }
    }

    /**
     * -------------------------------------------------------
     * | Job List.                                           | 
     * |                                                     |
     * | @param Request $request                             |
     * | @return Response                                    |
     * -------------------------------------------------------
     */
    public function jobByStatus(Request $request) 
    {
        $validator = Validator::make($request->all(), [ 'page_number' => 'required|integer|min:1', 'job_status' => 'required' ]); /** Validation code */
        if ( $validator->fails() ) {
            return $this->getResponse($this->blankObject,false,400,$validator->errors()->first());
        } else {
            if ( isset($request->engineer_id) && $request->engineer_id != null) {
                $tokenUserId = $request->engineer_id;
            } else {
                $tokenUserId = $request->user()->token()->user_id;
            }
            $currentPage = trim($request->page_number); // You can set this to any page you want to paginate to

            // Make sure that you call the static method currentPageResolver() before querying users
            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });
            $loggedInUser = $this->user::whereId($tokenUserId)->first();
            $jobObjData = $this->job::whereJobStatusId($request->job_status)->whereStatus(1)->whereNull('deleted_at');
            if ( $loggedInUser->user_type == config('constant.engineer') ) { /** Check if engineer or not */ 
                $jobObjData = $jobObjData->whereAssignedTo($loggedInUser->id);
            } else if ( $loggedInUser->user_type == config('constant.operator') ) { /** Check if operator or not */
                $jobObjData = $jobObjData->whereUserId($tokenUserId);
            }
            $jobObjData = $jobObjData->orderBy('created_at', 'DESC');
            $jobObj = $jobObjData->paginate(config('constant.job_page_limit')); /** Pagination */
            $jobResults = $jobObj->toArray();
            $jobFinalArr = [];

            foreach ($jobObj as $jobObjKey => $jobObjVal) { /** Used to display all faq */
                $jobArr['job_id'] = $jobObjVal->id;
                $jobArr['title'] = $jobObjVal->title;
                $jobArr['description'] = $jobObjVal->description;
                $jobArr['job_status'] = $jobObjVal->job_status_id;
                $jobArr['priority'] = $jobObjVal->priority;
                $jobArr['images'] = $this->getIndexJobImage($jobObjVal); /** Get first job image */
                $jobArr['created_at'] = date('Y-m-d H:i:s',strtotime($jobObjVal->created_at));
                $removedNullArr = removeNullFromArray($jobArr); /** To remove null value from array */
                array_push($jobFinalArr, $removedNullArr);
            }

            $jobArre['job_list'] = $jobFinalArr;
            $lastPage = $jobObj->lastPage(); /** Last page of record */
            if ($currentPage > $lastPage) { /** Check if this is last page or not */
                return  $this->getResponse($this->blankObject,false,405,__('api_messages.no_records_found'),'',$jobObj,$lastPage);
            } else {
                return count($jobFinalArr) > 0 ? $this->getResponse($jobArre,true,200,__('api_messages.job.jobs_list'),'',$jobObj,$lastPage) : $this->getResponse($this->blankObject,false,405,__('api_messages.no_records_found'),'',$jobObj,$lastPage);
            }
        }
    }

    /**
     * -------------------------------------------------------
     * | Get Job Images.                                     |
     * |                                                     |
     * | @param $jobObjVal                                   |
     * | @return Response                                    |   
     * -------------------------------------------------------
     */
    public function getJobImages($jobObjVal) 
    {
        $image = [];
        if (count($jobObjVal->jobImage ) > 0) { /** Show image of project */
            foreach ($jobObjVal->jobImage  as $val) {
                $image[] = [ 'image_id' => (string) $val->id, 'image_url' => $val->job_image ];
            }
        } else { /** Show default image of project */
            $image[] = [ 'image_id' => '', 'image_url' => asset('images/default.png') ];
        }
        return $image;
    }  
    
    /**
     * -------------------------------------------------------
     * |  Get First Job Image.                               |
     * |                                                     |
     * | @param $jobObjVal                                   |
     * | @return Response                                    |       
     * -------------------------------------------------------
     */
    public function getIndexJobImage($jobObjVal) 
    {
        if (count($jobObjVal->jobImage ) > 0) { /** Show image of project */
            $image['image_id'] = $jobObjVal->jobImage[0]->id;
            $image['image_url'] = $jobObjVal->jobImage[0]->job_image;
        } else { /** Show default image of project */
            $image['image_id'] = '';
            $image['image_url'] =  asset('images/default.png');
        }
        return $image;
    }

    /**
     * -------------------------------------------------------
     * | Filter By Priority.                                 |
     * |                                                     |
     * | @param Request $request                             |   
     * | @return Response                                    |
     * -------------------------------------------------------
     */
    public function filterByPriority(Request $request) 
    {
        $validator = Validator::make($request->all(), [ 'priority' => 'required|integer|min:1','page_number' => 'required|integer|min:1','job_status' => 'required|integer|min:1' ]); /** Validation code */
        if ( $validator->fails() ) {
            return $this->getResponse($this->blankObject,false,400,$validator->errors()->first());
        } else {
            if (!in_array($request->priority,[1,2,3,4])) { /** Check if given priority exists or not */
                return $this->getResponse($this->blankObject,false,400, __('api_messages.job.invalid_priority'));
            } else {
                if ( isset($request->engineer_id) && $request->engineer_id != null) {
                    $tokenUserId = $request->engineer_id;
                } else {
                    $tokenUserId = $request->user()->token()->user_id;
                }
                $currentPage = trim($request->page_number); // You can set this to any page you want to paginate to

                // Make sure that you call the static method currentPageResolver() before querying users
                Paginator::currentPageResolver(function () use ($currentPage) {
                    return $currentPage;
                });
                
                $loggedInUser = $this->user::whereId($tokenUserId)->first();

                $jobQuery = $this->job::whereStatus(config('constant.status_active_value'))->whereNull('deleted_at')->whereJobStatusId($request->job_status);

                if ( $request->priority == 1 ) { /** Check if filter by all */
                    $jobObjData = $jobQuery;
                } else {
                    if ( $loggedInUser->user_type == config('constant.manager') ) { /** Check if manager or not */
                        $jobObjData = $jobQuery->wherePriority($request->priority);
                    } else if ( $loggedInUser->user_type == config('constant.engineer') ) { /** Check if engineer or not */ 
                        $jobObjData = $jobQuery->whereAssignedTo($loggedInUser->id)->wherePriority($request->priority);
                    } else {
                        $jobObjData = $jobQuery->whereUserId($tokenUserId)->wherePriority($request->priority);
                    }
                }
                
                $jobObjData = $jobObjData->orderBy('created_at', 'DESC');
                $jobObj = $jobObjData->paginate(config('constant.job_page_limit')); /** Pagination */
                $jobResults = $jobObj->toArray();
                $jobFinalArr = [];
    
                foreach ($jobObj as $jobObjKey => $jobObjVal) { /** Used to display all faq */
                    $jobArr['job_id'] = $jobObjVal->id;
                    $jobArr['title'] = $jobObjVal->title;
                    $jobArr['description'] = $jobObjVal->description;
                    $jobArr['job_status'] = $jobObjVal->job_status_id;
                    $jobArr['priority'] = $jobObjVal->priority;
                    $jobArr['images'] = $this->getIndexJobImage($jobObjVal);
                    $jobArr['created_at'] = date('Y-m-d H:i:s',strtotime($jobObjVal->created_at));
                    $removedNullArr = removeNullFromArray($jobArr); /** To remove null value from array */
                    array_push($jobFinalArr, $removedNullArr);
                }
    
                $jobArre['job_list'] = $jobFinalArr;
                $lastPage = $jobObj->lastPage(); /** Last page of record */
                if ($currentPage > $lastPage) { /** Check if this is last page or not */
                    return  $this->getResponse($this->blankObject,false,405,__('api_messages.no_records_found'),'',$jobObj,$lastPage);
                } else {
                    return count($jobFinalArr) > 0 ? $this->getResponse($jobArre,true,200,__('api_messages.job.jobs_list'),'',$jobObj,$lastPage) : $this->getResponse($this->blankObject,false,405,__('api_messages.no_records_found'),'',$jobObj,$lastPage);
                }
            }
        }
    }

    /**
     * -------------------------------------------------------
     * | Decline Job.                                        |
     * |                                                     |
     * | @param Request $request                             |
     * | @return Response                                    |      
     * -------------------------------------------------------
     */
    public function declineJob(Request $request) 
    {
        $validator = Validator::make($request->all(), [ 'job_id' => 'required|integer','reason' => 'required' ]); /** Validation code */
        if ( $validator->fails() ) {
            return $this->getResponse($this->blankObject,false,400,$validator->errors()->first());
        } else {
            $tokenUserId = $request->user()->token()->user_id;
            $jobObjData = $this->job::whereUserId($tokenUserId)->whereId($request->job_id)->whereStatus(config('constant.status_active_value'))->whereNull('deleted_at')->first();
            if ( $jobObjData ) {
                if ( $jobObjData->job_status_id == config('constant.job_status_list.declined') ) { /** Check if already declined or not */ 
                    return $this->getResponse($this->blankObject,false,400, __('api_messages.job.already_declined'));    
                } else {
                    $message = 'Job request declined';
                    /** job declined send notification to operator starts here */
                    $usersList = $this->user::where('id','<>',$tokenUserId)->whereUserType(3)->whereStatus(1)->whereNotNull('email_verified_at')->whereIsVerify(1)->whereNull('deleted_at')->get();
                    if ($usersList->count() > 0) {
                        foreach ($usersList as $user) {
                            event(new UserNotificationEvent($user->id, $jobObjData->id, get_class($this->job), $message, 7)); /** Event activity record */
                        }
                        $this->sendPushNotificationToMultiple($jobObjData,$usersList,'job_declined','Job request declined','Job Declined ');
                    }
                    /** job declined send notification to operator ends here */

                    $jobObjData->update(['job_status_id' => config('constant.job_status_list.declined'), 'reason' => $request->reason]);
                    $user = $this->user::whereId($tokenUserId)->first();
                    $url = 'job/detail/'.$jobObjData->uuid;
                    $this->sendNotificationToAdmin($tokenUserId,$jobObjData->title.$message,$jobObjData->id,$url); /*Notifiy Admin */
                    return $this->getResponse($this->blankObject,true,200,__('api_messages.job.declined_msg'));
                }
            } else {
                return $this->getResponse($this->blankObject,false,400,__('api_messages.job.job_not_found'));
            }
        }
    }

    /**
     * -------------------------------------------------------
     * | Start Job.                                          |
     * |                                                     |
     * | @param Request $request                             |
     * | @return Response                                    |
     * -------------------------------------------------------
     */
    public function startJob(Request $request) 
    {
        $validator = Validator::make($request->all(), [ 'job_id' => 'required|integer' ]); /** Validation code */
        if ( $validator->fails() ) {
            return $this->getResponse($this->blankObject,false,400,$validator->errors()->first());
        } else {
            $tokenUserId = $request->user()->token()->user_id;
            $jobObjData = $this->job::whereUserId($tokenUserId)->whereId($request->job_id)->whereStatus(config('constant.status_active_value'))->whereNull(null)->first();
            if ( $jobObjData ) {
                if ( $jobObjData->job_status_id == config('constant.job_status_list.assigned') &&  $jobObjData->assigned_to != NULL ) { /** Check if already declined or not */ 
                    if ( $jobObjData->jobLogs->count() > 0 ) {
                        return $this->getResponse($this->blankObject,false,400,__('api_messages.job.job_already_started'));
                    } else {
                        /** Send job started notification to operator starts here */
                        $message = 'Job started';
                        $usersList = $this->user::where('id','<>',$tokenUserId)->whereUserType(3)->orWhere('user_type',1)->whereStatus(1)->whereNotNull('email_verified_at')->whereIsVerify(1)->whereNull('deleted_at')->get();
                        if ($usersList->count() > 0) {
                            foreach ($usersList as $user) {
                                event(new UserNotificationEvent($user->id, $jobObjData->id, get_class($this->job), $message, 5)); /** Event activity record */
                            }
                            $this->sendPushNotificationToMultiple($jobObjData,$usersList,'job_started','Job started','Job Started');
                        }
                        /** Send job started notification to operator ends here */

                        /** Update job status to completed */
                        $jobObjData->update(['job_status_id' => config('constant.job_status_list.ongoing')]);
                        $jobLog = new JobLog();
                        $log = $jobLog->create([ 'job_id' => $jobObjData->id, 'assigned_to' => @$jobObjData->assigned_to != NULL ? $jobObjData->assigned_to : NULL,'start_by' => $tokenUserId,'start_time' => now() ]);
                        $list['job_id'] = $jobObjData->id;
                        $list['job_start_datetime'] = date('Y-m-d H:i:s',strtotime($log->start_time));
                        // $logArr['job_log'] = $list;
                        return $this->getResponse($list,true,200,__('api_messages.job.job_started_msg'));
                    }
                } else {
                    return $this->getResponse($this->blankObject,false,400,__('api_messages.job.job_not_assigned_yet'));
                }
            } else {
                return $this->getResponse($this->blankObject,false,400,__('api_messages.job.job_not_found'));
            }
        }
    }

    /**
     * -------------------------------------------------------
     * | End Job.                                            |
     * |                                                     |
     * | @param Request $request                             |
     * | @return Response                                    |
     * -------------------------------------------------------
     */
    public function endJob(Request $request) 
    {
        $validator = Validator::make($request->all(), [ 'job_id' => 'required|integer','time_duration' => 'required|date_format:H:i:s' ]); /** Validation code */
        if ( $validator->fails() ) {
            return $this->getResponse($this->blankObject,false,400,$validator->errors()->first());
        } else {
            $tokenUserId = $request->user()->token()->user_id;
            $jobObjData = $this->job::whereUserId($tokenUserId)->whereId($request->job_id)->whereStatus(config('constant.status_active_value'))->whereNull('deleted_at')->first();
            if ( $jobObjData ) {
                if ( $jobObjData->assigned_to != NULL ) { /** Check if already declined or not */
                    if ( $jobObjData->jobLogs->count() > 0 ) {
                        if ( @$jobObjData->jobLogsEmptyDuration[0] ) {
                            /** Update job status to completed */
                            $jobObjData->update(['job_status_id' => config('constant.job_status_list.completed')]);
                            $log = $jobObjData->jobLogsEmptyDuration[0];
                            $log->update(['end_by' => $tokenUserId,'duration' => $request->time_duration,'end_time' => now()]);
                            $user = $this->user::whereId($tokenUserId)->first();
                            $url = 'job/detail/'.$jobObjData->uuid;
                            $message = 'Job completed';
                            $this->sendNotificationToAdmin($tokenUserId,$jobObjData->title.$message,$jobObjData->id,$url); /*Notifiy Admin */

                            /** Send job completed notification to manager/operator starts here */
                            $usersList = $this->user::where('id','<>',$tokenUserId)->whereUserType(1)->orWhere('user_type',3)->whereStatus(1)->whereNotNull('email_verified_at')->whereIsVerify(1)->whereNull('deleted_at')->get();
                            if ($usersList->count() > 0) {
                                foreach ($usersList as $user) {
                                    event(new UserNotificationEvent($user->id, $jobObjData->id, get_class($this->job), $message, 2)); /** Event activity record */
                                }
                                $this->sendPushNotificationToMultiple($jobObjData,$usersList,'job_completed','Job completed','Job Completed');
                            }
                            /** Send job completed notification to manager/operator ends here */

                            return $this->getResponse($this->blankObject,true,200,__('api_messages.job.job_ended_msg'));    
                        } else {
                            return $this->getResponse($this->blankObject,false,400,__('api_messages.job.job_already_ended'));    
                        }
                    } else {
                        return $this->getResponse($this->blankObject,false,400,__('api_messages.job.job_not_started_yet'));
                    }
                } else {
                    return $this->getResponse($this->blankObject,false,400,__('api_messages.job.job_not_assigned_yet'));
                }
            } else {
                return $this->getResponse($this->blankObject,false,400,__('api_messages.job.job_not_found'));
            }
        }
    }

    /**
     * -------------------------------------------------------
     * | Accept Job.                                         |
     * |                                                     |
     * | @param Request $request                             |
     * | @return Response                                    |
     * -------------------------------------------------------
     */
    public function acceptJob(Request $request) 
    {
        $validator = Validator::make($request->all(), [ 'job_id' => 'required|exists:jobs,id', 'priority' => 'required|integer', 'engineer_id' => Rule::requiredIf(($request->type == 2)), 'engineer_id' => 'integer', 'type' => 'required|integer' ]); /** Validation code */
        if ( $validator->fails() ) {
            return $this->getResponse($this->blankObject,false,400,$validator->errors()->first());
        } else {
            $user = $this->user::whereId($request->engineer_id)->whereStatus(config('constant.status_active_value'))->whereNull('deleted_at')->whereUserType(config('constant.engineer'))->first();
            if ( !$user ) {
                return $this->getResponse($this->blankObject,false,400, __('api_messages.job.engineer_no_longer_msg'));
            } 
            if ( !in_array($request->priority,[2,3,4]) ) { /** Check if given priority exists or not */
                return $this->getResponse($this->blankObject,false,400, __('api_messages.job.invalid_priority'));
            } else {
                // 1 = KIV, 2 = Assign Engineer
                if ( !in_array($request->type,[1,2]) ) { /** Check if given type exists or not */
                    return $this->getResponse($this->blankObject,false,400, __('api_messages.job.invalid_type_provided'));
                } else {
                    $tokenUserId = $request->user()->token()->user_id;
                    $jobObjData = $this->job::whereUserId($tokenUserId)->whereId($request->job_id)->whereStatus(config('constant.status_active_value'))->whereNull('deleted_at')->first();
                    if ( $jobObjData ) {
                        $user = $this->user::whereId($tokenUserId)->first();
                        $url = 'job/detail/'.$jobObjData->uuid;
                        $message = 'Job request accepted';
                        $assignedMessage = 'Engineer assigned to job';
                        $this->sendNotificationToAdmin($tokenUserId,$jobObjData->title.$message,$jobObjData->id,$url); /*Notifiy Admin */

                        /** Send job request accepted to operator starts here */
                        $usersList = $this->user::where('id','<>',$tokenUserId)->whereUserType(3)->whereStatus(1)->whereNotNull('email_verified_at')->whereIsVerify(1)->whereNull('deleted_at')->get();
                        if ($usersList->count() > 0) {
                            foreach ($usersList as $user) {
                                event(new UserNotificationEvent($user->id, $jobObjData->id, get_class($this->job), $message, 3)); /** Event activity record */
                                event(new UserNotificationEvent($user->id, $jobObjData->id, get_class($this->job), $assignedMessage, $request->type == 1 ? 8 : 4)); /** Event activity record */
                            }
                            $this->sendPushNotificationToMultiple($jobObjData,$usersList,'job_accepted','Job request accepted','Job Accepted');
                            $this->sendPushNotificationToMultiple($jobObjData,$usersList,'engineer_assigned','Engineer assigned to job','Engineer Assigned');
                        }
                        /** Send job request accepted to operator ends here */

                        /** Send job engineer assigned to engineer starts here */
                        $usersList = $this->user::where('id','<>',$tokenUserId)->whereUserType(2)->whereStatus(1)->whereNotNull('email_verified_at')->whereIsVerify(1)->whereNull('deleted_at')->get();
                        if ($usersList->count() > 0) {
                            foreach ($usersList as $user) {
                                event(new UserNotificationEvent($user->id, $jobObjData->id, get_class($this->job), $assignedMessage, $request->type == 1 ? 8 : 4)); /** Event activity record */
                            }
                            $this->sendPushNotificationToMultiple($jobObjData,$usersList,'engineer_assigned','Engineer assigned to job','Engineer Assigned');
                        }
                        /** Send job request accepted to engineer ends here */

                        if ( $request->type == 1 ) { // KIV (Keep In View)
                            $jobObjData->update(['job_status_id' => config('constant.job_status_list.kiv') ]);
                            return $this->getResponse($this->blankObject,false,400, __('api_messages.job.kiv_saved'));
                        } else { // Assign Engineer
                            $jobObjData->update(['assigned_to' => $request->engineer_id, 'priority' => $request->priority,'job_status_id' => config('constant.job_status_list.assigned') ]);
                            return $this->getResponse($this->blankObject,false,400, __('api_messages.job.priority_set_msg'));
                        }   
                    } else {
                        return $this->getResponse($this->blankObject,false,400,__('api_messages.job.job_not_found'));
                    }
                }
            }
        }
    }


    /** 
     * --------------------------------------------------------------------------------
     * | Send Push Notifications To Multpile Users                                    |   
     * |                                                                              | 
     * | @param $notificationData,$userNotificationObj,$type,$message,$title          |
     * |                                                                              |                     
     * --------------------------------------------------------------------------------
     */
    public function sendPushNotificationToMultiple($notificationData,$userNotificationObj,$type,$message,$title) 
    {
        foreach($userNotificationObj as $userObjKey => $userObjVal) {
            if (@$userObjVal->usersFcmTokens[0]) {
                $userToken = $userObjVal->usersFcmTokens[0]['fcm_token'];
                $userDeviceType = $userObjVal->usersFcmTokens[0]['device_type'];
                $fcmData = [
                    'job_id' => (int) $notificationData->id,
                    'type' => $type,
                    'message' => $message,
                ];
                $this->basicPushNotification($title, $message, $fcmData, $userToken, $userDeviceType);
            }
        }
    }

    /** 
     * --------------------------------------------------------------------------------
     * | Send Push Notifications To Single User                                       |   
     * |                                                                              | 
     * | @param $notificationData,$userNotificationObj,$type,$message,$title          |
     * |                                                                              |                     
     * --------------------------------------------------------------------------------
     */
    public function sendPushNotificationToSingle($notificationData,$userNotificationObj,$type,$message,$title) 
    {
        if (@$userNotificationObj->usersFcmTokens[0]) {
            $userToken = $userNotificationObj->usersFcmTokens[0]['fcm_token'];
            $userDeviceType = $userNotificationObj->usersFcmTokens[0]['device_type'];
            $fcmData = [
                'job_id' => (int) $notificationData->id,
                'type' => $type,
                'message' => $message,
            ];
            $this->basicPushNotification($title, $message, $fcmData, $userToken, $userDeviceType);
        }
    }
}
?>