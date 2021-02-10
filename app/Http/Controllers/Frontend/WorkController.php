<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\EarningHelper;
use App\Models\App;
use App\Models\Earning;
use App\Models\LoanDocument;
use App\Models\LoanNotification;
use App\Models\User;
use App\Models\UserEarning;
use App\Models\WithDrawRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;


class WorkController extends BaseController
{
    public $viewConstant = 'frontend.work.';
    private $helper, $user;
    public function __construct(EarningHelper $helper, User $user)
    {
        $this->helper = $helper;
        $this->user = $user;
    }


    public function index($slug=null){
        if($slug){
            $app = App::whereSlug($slug)->first();
            $earning = Earning::where('app_id',$app->id)->where('user_id',Auth::id())->first();
        }else{
            $app = App::first();
            if($app){
                $earning = Earning::where('app_id',$app->id)->where('user_id',Auth::id())->first();
            }
        }
        return view($this->viewConstant.'index',['slug'=>@$slug,'app'=>@$app,'earning'=>@$earning]);
    }

    public function create($slug=null){
        $app = App::whereSlug($slug)->first();
        $earning = Earning::where('app_id',$app->id)->where('user_id',Auth::id())->first();
        if($earning){
            $frontLicence = LoanDocument::whereEarningId($earning->id)->whereType(1)->first();
            $addressProof = LoanDocument::whereEarningId($earning->id)->whereType(3)->first();
        }
        // dd($earning);
        return view($this->viewConstant.'create',['slug'=>@$slug,'app'=>@$app,'earning'=>@$earning, 'frontLicence'=>@$frontLicence,'addressProof'=>@$addressProof]);
    }

    public function store(Request $request, $uuid = null)
    {
        $this->helper->dbStart();
        try {
            $rules = [
                'first_name' => 'required|max:'.config('constant.name_length'),
                'last_name' => 'required|max:'.config('constant.name_length'),
                // 'middle_name' => 'required|max:'.config('constant.name_length'),
                // 'phone1'=>'required|max:'.config('constant.max_phone_length'),
                // 'phone2'=> 'required|max:'.config('constant.phone_length'),
                'address1'=>'required|max:'.config('constant.text_length'),
                'city'=>'required|max:'.config('constant.name_length'),
                'state'=>'required|max:'.config('constant.name_length'),
                'zip_code'=>'required|max:'.config('constant.zip_code_length'),
                'ssn' => 'required',
                'dob' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
            {
                return redirect()->back()->with('errors', $validator->errors());
            }
            $this->helper->store($request, $uuid);
            $this->helper->dbEnd();
            if ($request->has('id') && !empty($request->id)) {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.updated'), 'type' => 'Earning']);
            } else {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.created'), 'type' => 'Earning']);
            }
            return redirect()->route('earning')->with('message', $msg);
        } catch (Exception $e) {
            $this->helper->dbRollBack();
            return Redirect::back()->with('error', $e->getMessage());
            abort('404');
        }
    }

    /**
     * -------------------------------------------------
     * | Get company datatable data                    |
     * |                                               |
     * | @param Request $request                       |
     * | @return View                                  |
     * |------------------------------------------------
     */
    public function getdata(Request $request,$appId=null)
    {
        // try {
            $earnings = UserEarning::whereAppId($appId);
            $earningList = $earnings->where(function ($query) use ($request) {
                                if ($request->status) {
                                    $query->activeSearch($request->status);
                                }
                            })
                            ->whereHas('earningUser',function($query){
                                $query->where('user_id',Auth::id());
                            })
                            ->where('status','=',0)
                            ->get();
            return DataTables::of($earningList)
                ->editColumn('created_at', function ($earning) {
                    return @$earning->proper_created_at;
                })
                ->editColumn('app_id', function ($earning) {
                    return @$earning->app->title;
                })
                ->editColumn('full_name', function ($earning) {
                    return $earning->earningUser->full_name_text;
                })
                ->editColumn('email', function ($earning) {
                    return @$earning->earningUser->user->email;
                })
                ->editColumn('amount', function ($earning) {
                    return @config('constant.currency_symbol').$earning->amount;
                })
                ->editColumn('date', function ($earning) {
                    return @$earning->proper_date;
                })
                ->rawColumns(['date','app_id','amount','user_id','full_name','email','created_at', 'checkbox', 'action', 'status'])
                ->make(true);
        // } catch (Exception $e) {
        //     abort('404');
        // }
    }
    public function withdrawRequest($appId,$earningId){
        $date = date('Y-m-d');
        $userId = Auth::id();
        $request = WithDrawRequest::where('date',$date)->whereAppId($appId)->whereEarningId($earningId)->first();
        $userEarning = UserEarning::whereAppId($appId)->whereHas('earningUser',function($query)use($userId){
                        $query->whereUserId($userId);
                        })->get();
        if($userEarning == null){
            return redirect()->back()->with('warning', 'No Earning record found');
        }
        if($request){
            $msg = 'Withdraw request already sent';
        }else{
            $request = WithDrawRequest::create(['app_id'=>$appId,'date'=>$date,'earning_id'=>$earningId]);
            $msg = 'Withdraw request sent successfully';
        }
        return redirect()->back()->with('success', $msg);
    }

    public function clearNotification($type=null){
        $loanNotification = LoanNotification::whereUserId(Auth::id())->whereType($type)->update(['is_read'=>1]);
        return redirect()->back();
    }
}
