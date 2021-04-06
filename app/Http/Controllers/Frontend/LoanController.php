<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\BaseHelper;
use Exception;
use App\Models\User;
use PDF;
use App\Models\LoanDocument;
use App\Models\UserDocument;
use Illuminate\Http\Request;
use App\Models\UserLoanDetail;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\UserFormRequest;
use App\Http\Controllers\Frontend\BaseController;
use App\Models\CMS;
use App\Models\LoanTransaction;

class LoanController extends BaseController
{
    public $viewConstant = 'frontend.loan.';
    
    public function __construct(BaseHelper $baseHelper)
    {
        $this->helper = $baseHelper;
    }

    public function applyLoan(Request $request){
        session()->put([
            'amount' => $request->amount,
            'year' => $request->year
        ]);
        return redirect('calculate');
    }
    public function calculate(Request $request){
        $amount = session()->get('amount');
        $tableData = [];
        $setting = setting();
        if($setting){            
            $pr = ($setting->percentage)?$setting->percentage:config('constant.default_pr');
        }else{
            $pr = config('constant.default_pr');
        }
        for($i=1;$i<=5;$i++){
            $principle = $amount * ($pr*$i) / 100;
            $months = $i * 12;
            $returnPerMonth = ($amount + $principle) / $months;
            $tableData[$i]['months'] = $months;
            $tableData[$i]['returnPerMonth'] = number_format($returnPerMonth,1);
            $tableData[$i]['amount'] = $amount;
            $tableData[$i]['per'] = $pr.config('constant.pr_symbol');
        }
        return view($this->viewConstant.'calculate',['tableData'=>@$tableData]);
    }

    public function applyForLoan(Request $request){
        session()->put('loanData',$request->all());
        return redirect()->route('loan.detail');
    }

    public function loanDetail(){
        $data = session()->get('loanData');
        $yearList = $this->yearList();
        $accountTypeList = $this->accountTypeList();
        $loanTypes = $this->loanTypes();
        return view($this->viewConstant.'create',['loanData'=>$data,'accountTypeList'=>@$accountTypeList,'yearList'=>@$yearList,'loanTypes'=>@$loanTypes]);
    }

    public function store(Request $request){
        $this->dbStart();
        try{
                $rules = [
                'first_name' => 'required|max:'.config('constant.name_length'),
                'last_name' => 'required|max:'.config('constant.name_length'),
                // 'middle_name' => 'required|max:'.config('constant.name_length'),
                'phone1'=>'required|max:'.config('constant.max_phone_length'),
                // 'phone2'=> 'required|max:'.config('constant.phone_length'),
                'address1'=>'required|max:'.config('constant.text_length'),
                'city'=>'required|max:'.config('constant.name_length'),
                'state'=>'required|max:'.config('constant.name_length'),
                'zip_code'=>'required|max:'.config('constant.zip_code_length'),
                'bank_name' =>'required|max:'.config('constant.name_length'),
                'account_type' => 'required',
                'account_number' => 'required|max:'.config('constant.name_length'),
                // 'confirm_account_number' => 'required|max:'.config('constant.name_length').'|same:account_number',
                // 'bank_address' =>'required|max:'.config('constant.text_length'),
                'loan_amount' => 'required|max:'.config('constant.amount_length'),
                'months' => 'required|max:'.config('constant.name_length'),
                'repayment_amount' =>'required|max:'.config('constant.name_length'),
                // 'past_loan' => 'required',
                'ssn' => 'required',
                'dob' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if(Auth::user()){
                $user = User::find(Auth::guard('web')->id());
            }else{
                $rules['email'] = 'required|max:'.config('constant.email_length').'|unique:users,email,NULL,id,deleted_at,NULL';
                $rules['password'] = 'required|max:'.config('constant.password_max_length').'|min:'.config('constant.password_min_length');
                $rules['confirm_email'] = 'required|same:email|max:'.config('constant.email_length');
                $rules['confirm_password'] = 'required|same:password|max:'.config('constant.password_max_length').'|min:'.config('constant.password_min_length');
                $user = New User();
                $request['phone'] = $request->phone1;
                $request['address'] = $request->address1;
                $request['password'] = Hash::make($request->password);
                $user->fill($request->all())->save();
            }
            // dd($user);
            if ($validator->fails())
            {
                return response()->json(array(
                    'errors' => $validator->getMessageBag()->toArray()
                ), 200); // 400 being the HTTP code for an invalid request.
            }
            $request['password'] = Hash::make($request->password);
            array_set($request,'user_id',$user->id);
            array_set($request,'past_loan',isset($request->past_loan)?$request->past_loan:1);
            array_set($request,'pending_loan',isset($request->pending_loan)?$request->pending_loan:1);
            array_set($request,'pending_bill',isset($request->pending_bill)?$request->pending_bill:1);
            array_set($request,'dob',date('Y-m-d',strtotime($request->dob)));
            // $user->bankDetail()->create($request->all());
            // $autoAccountNo = generateStudentNo();
            // array_set($request,'auto_account_number',$autoAccountNo);
            $loan = $user->loanDetail()->create($request->all());
            $view = 'email.apply_loan';
            $templateSlug = config('constant.mail_template.3');
            $this->helper->sendMailToUser($templateSlug,$view, $user,null,$user->lastLoanDetail);
            $templateSlug2 = config('constant.mail_template.4');
            $view2 = 'email.identity_verification';
            $this->helper->sendMailToUser($templateSlug2,$view2, $user,null,$user->lastLoanDetail);
            if(count($loan->transactions) == 0){
                $transactionData = [];
                for($i=1; $i <= $request->months; $i++){
                    $transactionData[$i]['month'] = $i;
                    $transactionData[$i]['loan_id'] = $loan->id;
                    $transactionData[$i]['user_id'] = $user->id;
                }
                LoanTransaction::insert($transactionData);
            }
            $this->dbCommit();
            $msg = __('admin/messages.action_msg', ['action' => 'Created', 'type' => 'Loan Application']);
            return response()->json(['msg' => $msg, 'icon' => 'success']);
        } catch (Exception $e) {
            $this->dbRollBack();
            return response()->json(['errors' => $e->getMessage(), 'msg' => $e->getMessage(), 'icon' => 'info'], 200);
        }

    }

    public function application(){
        return view($this->viewConstant.'index',['tableData'=>[]]);
    }

        /**
     * -------------------------------------------------
     * | Get product category datatable data           |
     * |                                               |
     * | @param Request $request                       |
     * | @return View                                  |
     * |------------------------------------------------
     */
    public function getdata(Request $request)
    {
        try {
            $loanList = UserLoanDetail::whereUserId($request->extraParam)
                        ->where(function ($query) use ($request) {
                            if ($request->status) {
                                $query->activeSearch($request->status);
                            }
                        })
                        ->get();
            return DataTables::of($loanList)
                ->addColumn('action', function ($loan) {
                    return $this->getPartials($this->viewConstant . '_add_action', ['loan' => @$loan]);
                })
                ->editColumn('status', function ($loan) {
                    return $this->getPartials($this->viewConstant . '_add_status', ['loan' => @$loan]);
                })
                ->editColumn('created_at', function ($loan) {
                    return $loan->proper_created_at;
                })
                ->editColumn('document_status', function ($loan) {
                    return $this->getPartials($this->viewConstant . '_add_doc_status', ['loan' => @$loan]);
                })
                ->editColumn('loan_amount', function ($loan) {
                    return @config('constant.currency_symbol').$loan->loan_amount;
                })
                ->rawColumns(['auto_account_number','loan_amount','created_at', 'action', 'document_status','status'])
                ->make(true);
        } catch (Exception $e) {
            abort('404');
        }
    }

    public function detail($uuid){
        $loanDetail = UserLoanDetail::whereUuid($uuid)->first();
        // dd($loanDetail);
        $frontLicence = LoanDocument::whereLoanId($loanDetail->id)->whereType(1)->first();
        $backLicence = LoanDocument::whereLoanId($loanDetail->id)->whereType(2)->first();
        $addressProof = LoanDocument::whereLoanId($loanDetail->id)->whereType(3)->first();
        $selfie = LoanDocument::whereLoanId($loanDetail->id)->whereType(4)->first();
        // dd($frontLicence,$backLicence,$addressProof,$selfie);
        return view($this->viewConstant.'detail',['user'=>@$loanDetail,'frontLicence'=>@$frontLicence,'backLicence'=>@$backLicence,'addressProof'=>@$addressProof,'selfie'=>@$selfie]);
    }

    public function document($id=null){
        $userLoanDetail = UserLoanDetail::whereUuid($id)->first();
        // dd($userLoanDetail);
        $request['loan_id'] = $userLoanDetail->id;
        $loanDocuments = LoanDocument::whereLoanId($userLoanDetail->id)->first();
        $frontLicence = LoanDocument::whereLoanId($userLoanDetail->id)->whereType(1)->first();
        $backLicence = LoanDocument::whereLoanId($userLoanDetail->id)->whereType(2)->first();
        $addressProof = LoanDocument::whereLoanId($userLoanDetail->id)->whereType(3)->first();
        $selfie = LoanDocument::whereLoanId($userLoanDetail->id)->whereType(4)->first();
        // dd($frontLicence->image_path,$backLicence->image_path,$addressProof->image_path,$selfie->image_path);
        return view('frontend.my_information',['loan_id'=>@$userLoanDetail->id,'loanDocuments'=>@$loanDocuments,'frontLicence'=>@$frontLicence,'backLicence'=>@$backLicence,'addressProof'=>@$addressProof,'selfie'=>@$selfie]);
    }

    public function documentUpload(Request $request){
        // dd($request->all());
        $rules = [
            'front_licence' => 'required',
            'back_licence' => 'required',
            'address_proof' => 'required',
            'selfie' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            return redirect()->back()->with('errors', $validator->errors());
        }
        $user = Auth::guard('web')->user();
        $folderName = 'user-'.$user->id;
        $data['status'] = 0;
        if ($request->hasFile('front_licence')){
            $data['name'] = $this->storeImage($request->front_licence, $folderName);
            $loandata[] = LoanDocument::updateOrCreate(['loan_id'=>$request->loan_id,'type'=>1],$data);
        }
        if($request->hasFile('back_licence')){
            $data['name'] = $this->storeImage($request->back_licence, $folderName);
            $loandata[] = LoanDocument::updateOrCreate(['loan_id'=>$request->loan_id,'type'=>2],$data);
        }
        if($request->hasFile('address_proof')){
            $data['name'] = $this->storeImage($request->address_proof, $folderName);
            $loandata[] = LoanDocument::updateOrCreate(['loan_id'=>$request->loan_id,'type'=>3],$data);
        }
        if($request->hasFile('selfie')){
            $data['name'] = $this->storeImage($request->selfie, $folderName);
            $loandata[] = LoanDocument::updateOrCreate(['loan_id'=>$request->loan_id,'type'=>4],$data);
        }
        $data['user_id'] = $user->id;
        $view = 'email.identity_under_process';
        $templateSlug = config('constant.mail_template.5');
        $this->helper->sendMailToUser($templateSlug,$view, $user, null,null);
        $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.uploaded'), 'type' => 'User Document']);
        return redirect()->route('application')->with('message', $msg);
        // return redirect()->route('application')->with('message', $msg);
    }

    /**
     * ------------------------------------------------------
     * | Store image                                        |
     * |                                                    |
     * | @param $request,$user                              |
     * |-----------------------------------------------------
     */
    public function storeImage($request, $folderName)
    {
        $imageFunction = $this->uploadImage($request, $folderName,240,320);
        return @$imageFunction;
    }

    public function identy($uuid=null){
        $content = CMS::wherePageSlug('identification')->first();
        return view($this->viewConstant.'identy',['uuid'=>@$uuid,'content'=>@$content]);
    }

    public function identyStore(Request $request){
        $user = Auth::guard('web')->user();
        $userDocumnet = UserDocument::whereUserId($user->id)->update(['identy'=>$request->identy]);
        $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.uploaded'), 'type' => 'User Document']);
        return redirect()->route('application')->with('message', $msg);
    }

    public function documentStore(Request $request,$type=null){
        $user = Auth::guard('web')->user();
        $routeName=  Route::currentRouteName();
        if($routeName == 'store.loan.document'){
            $userLoanDetail = UserLoanDetail::whereUuid($request->loan_id)->first();
            if ($request->hasFile('file')){
                $request['loan_id'] = $userLoanDetail->id;
                $request['status'] = 0;
                $folderName = 'loan-'.$user->id;
                $request['name'] = $this->storeImage($request->file, $folderName);
            }
            LoanDocument::updateOrCreate(['loan_id'=>$userLoanDetail->id,'type'=>$type],$request->all());
            $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.uploaded'), 'type' => 'User Document']);
        }else{
            if ($request->hasFile('file')){
                $request['status'] = 0;
                $request['name'] = $this->storeImage($request->file, 'earning');
            }
            $request['type'] = $type;
            if($request->earning_id == null){
                $doc = new LoanDocument();
                $doc->create($request->all());
            }else{
                $request['earning_id'] = $request->earning_id;
                $doc = LoanDocument::whereEarningId($request->earning_id)
                        ->whereType($request->type)
                        ->first();
                if($doc){
                    $doc->update($request->all());
                }else{
                    $doc = new LoanDocument();
                    $doc->create($request->all());
                }
            }
            $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.uploaded'), 'type' => 'Earning Document']);
        }
        return response()->json(['msg' => $msg, 'icon' => 'success','filename'=>$request['name']]);
    }

    public function receipt(){
        return view($this->viewConstant.'receipt');
    }

    public function download($uuid){
        $userLoanDetail = UserLoanDetail::whereUuid($uuid)->first();
        return view('frontend.loan.receipt',['user'=>@$userLoanDetail]);
    }

        /**
     * -----------------------------------------------------
     * | Validate title                                    |
     * |                                                   |
     * | @param Request $request                           |
     * | @return Response                                  |
     * -----------------------------------------------------
     */
    public function validateEmail(Request $request)
    {
        $rules = array(
            'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL',
        );
        $validator = Validator::make($request->all(), $rules);
        $msg = true;
        if ($validator->fails()) {
            $msg = false;
        }
        return json_encode($msg);
    }
}
