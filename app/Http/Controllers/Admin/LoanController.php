<?php

namespace App\Http\Controllers\Admin;

use App\Exports\LoanExport;
use App\Helpers\LoanHelper;
use Illuminate\Http\Request;
use App\Helpers\UserHelper;
use App\Http\Requests\Admin\BankAccountFormRequest;
use App\Http\Requests\Admin\LoanFormRequest;
use Yajra\Datatables\Datatables;
use App\Http\Requests\Admin\ProductCategoryFormRequest;
use App\Http\Requests\Admin\UserFormRequest;
use App\Models\BankAccount;
use App\Models\LoanDocument;
use App\Models\LoanTransaction;
use App\Models\User;
use App\Models\UserLoanDetail;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Kreait\Firebase\Database\Transaction;
use Maatwebsite\Excel\Facades\Excel;

class LoanController extends BaseController
{
    public $helper, $user;
    public $viewConstant = 'admin.loan.';
    public function __construct(LoanHelper $helper, User $user)
    {
        $this->helper = $helper;
        $this->user = $user;
        $this->helper->mode = 'admin';
    }
    /**
     * -------------------------------------------------
     * | Display Product Category list                 |
     * |                                               |
     * | @return View                                  |
     * |------------------------------------------------
     */
    public function index()
    {
        try {
            $statusList = $this->loanStatusList();
            return view($this->viewConstant . 'index', ['statusList' => @$statusList]);
        } catch (Exception $e) {
            abort(404);
        }
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
            $userList = UserLoanDetail::where(function($q)use($request){
                            // if($request->status != null){
                                // $q->whereStatus($request->status);
                            // }
                        })->get();
            return Datatables::of($userList)
                ->addColumn('action', function ($user) {
                    return $this->getPartials($this->viewConstant . '_add_action', ['user' => $user]);
                })
                ->editColumn('status', function ($user) {
                    return $this->getPartials($this->viewConstant . '_add_status', ['user' => $user]);
                })
                ->editColumn('created_at', function ($user) {
                    return $user->proper_created_at;
                })
                ->editColumn('loan_amount', function ($loan) {
                    return @config('constant.currency_symbol').$loan->loan_amount;
                })
                ->editColumn('document_status', function ($loan) {
                    return $this->getPartials($this->viewConstant . '_add_doc_status', ['loan' => @$loan]);
                })
                ->addColumn('checkbox', function ($user) {
                    return $this->getPartials($this->viewConstant . '_add_checkbox', ['user' => $user]);
                })
                ->rawColumns(['document_status','created_at', 'checkbox', 'action', 'status'])
                ->make(true);
        } catch (Exception $e) {
            abort('404');
        }
    }

    /**
     * -------------------------------------------------
     * | Create product category page                  |
     * |                                               |
     * | @param $id                                    |
     * | @return View                                  |
     * |------------------------------------------------
     */
    public function create($uuid = null)
    {
        try {
            $routeName = Route::currentRouteName();
            $userUuid = $uuid;
            if($uuid){
                if (isset($uuid)) {
                    $loanUser = $this->helper->detail($uuid);
                }
                $title = 'Update Loan';
                $loanDocuments = LoanDocument::whereLoanId($loanUser->id)->first();
                $frontLicence = LoanDocument::whereLoanId($loanUser->id)->whereType(1)->first();
                $backLicence = LoanDocument::whereLoanId($loanUser->id)->whereType(2)->first();
                $addressProof = LoanDocument::whereLoanId($loanUser->id)->whereType(3)->first();
                $selfie = LoanDocument::whereLoanId($loanUser->id)->whereType(4)->first();
            }else{
                $title = 'Create Loan';
            }
            $statusList = $this->properStatusList();
            $loanStatusList = $this->loanStatusList();
            $userList = $this->userList();
            $yearList = $this->yearList();
            $accountTypeList = $this->accountTypeList();
            $loanTypes = $this->loanTypes();
            return view($this->viewConstant . 'create', ['loanTypes'=>@$loanTypes,'accountTypeList'=>@$accountTypeList,'yearList'=>@$yearList,'userList'=>@$userList,'loanStatusList'=>@$loanStatusList,'user' => @$loanUser, 'title' => @$title,'statusList' => @$statusList,'userUuid'=>$userUuid,'frontLicence'=>@$frontLicence,'backLicence'=>@$backLicence,'addressProof'=>@$addressProof,'selfie'=>@$selfie]);
        } catch (Exception $e) {
            abort(404);
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    /**
     * -------------------------------------------------
     * | Store product category details                |
     * |                                               |
     * | @param SubjectFormRequest $request            |
     * | @return View                                  |
     * |------------------------------------------------
     */
    public function store(LoanFormRequest $request, $uuid = null)
    {
        $this->helper->dbStart();
        try {
            $user = $this->helper->store($request, $uuid);
            $this->helper->dbEnd();
            if ($request->has('id') && !empty($request->id)) {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.updated'), 'type' => 'Loan']);
            } else {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.created'), 'type' => 'Loan']);
            }
            return redirect()->route('loan.index')->with('message', $msg);
        } catch (Exception $e) {
            $this->helper->dbRollBack();
            return Redirect::back()->with('error', $e->getMessage());
            abort('404');
        }
    }
    /**
     * -------------------------------------------------
     * | Delete product category details               |
     * |                                               |
     * | @param Request $request                       |
     * | @return Response                              |
     * |------------------------------------------------
     */
    public function destroy(Request $request)
    {
        $this->helper->dbStart();
        try{
            if (isset($request->id)) {
                $this->helper->delete($request->id);
                $this->helper->dbEnd();
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.deleted'), 'type' => 'Loan']);
                return response()->json(['msg' => $msg, 'icon' => 'success']);
            }else {
                return response()->json(['msg' => Lang::get('formname.not_found'), 'icon' => 'info']);
            }
        } catch (Exception $e) {
            $this->helper->dbRollBack();
            return response()->json(['msg' => $e->getMessage(), 'icon' => 'info']);
        }
    }
    /**
     * -------------------------------------------------
     * | Delete multiple product category              |
     * |                                               |
     * | @param Request $request                       |
     * | @return Response                              |
     * |------------------------------------------------
     */
    public function multidelete(Request $request)
    {
        $this->helper->dbStart();
        try{
            $this->helper->multiDelete($request);
            $this->helper->dbEnd();
            if ($request->action == config('constant.approve') || $request->action == config('constant.reject')) {
                $action = ($request->action == config('constant.approve'))?__('admin/messages.approved'):__('admin/messages.reject');
                $msg = __('admin/messages.action_msg', ['action' => $action, 'type' => 'Loan']);
                return response()->json(['msg' => $msg, 'icon' => 'success']);
            } else {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.deleted'), 'type' => 'Loan']);
                return response()->json(['msg' => @$msg, 'icon' => 'success']);
            }
        } catch (Exception $e) {
            $this->helper->dbRollBack();
            return response()->json(['msg' => $e->getMessage(), 'icon' => 'info']);
        }
    }
    /**
     * -------------------------------------------------
     * | Update product category status details        |
     * |                                               |
     * | @param Request $request                       |
     * | @return View                                  |
     * |------------------------------------------------
     */
    public function updateStatus(Request $request)
    {
        $this->helper->dbStart();
        try{
            if (isset($request->id)) {
                $msg = $this->helper->statusUpdate($request->id);
                $this->helper->dbEnd();
                return response()->json(['msg' => $msg, 'icon' => 'success']);
            } else {
                return response()->json(['msg' => __('admin/messages.not_found'), 'icon' => 'info']);
            }
        } catch (Exception $e) {
            $this->helper->dbRollBack();
            return response()->json(['msg' => $e->getMessage(), 'icon' => 'info']);
        }
    }

    public function update($uuid){
        $loan = $this->helper->detail($uuid);
        $user = $loan->user;
        $routeName = Route::currentRouteName();
        if($routeName == 'loan.approve'){
            $loan->update(['status'=>1]);
            $status = 1;
            $view = 'email.loan_confirmed';
            $templateSlug = config('constant.mail_template.11');
            $this->helper->sendMailToUser($templateSlug,$view, $user,null,$loan);
        }else{
            $status = 2;
            $loan->update(['status'=>2]);
            $view = 'email.loan_declined';
            $templateSlug = config('constant.mail_template.12');
            $this->helper->sendMailToUser($templateSlug,$view, $user,null,$loan);
        }
        $action = ($status == 1)?__('admin/messages.approved'):__('admin/messages.reject');
        $this->sendNotification($loan,$action,'1');
        $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.updated'), 'type' => 'Loan']);
        return redirect()->route('loan.index')->with('message', $msg);
    }

    public function docStatus(Request $request){
        try{
            $data = LoanDocument::whereUuid($request->id)->first();
            LoanDocument::whereUuid($request->id)->update(['status'=>$request->status]);
            $docType =config('constant.docType')[$data->type];
            $action = ($request->status==1)?__('admin/messages.approved'):__('admin/messages.reject');
            $this->sendNotification($data,$action,'1',$docType);
            $user = $data->loan->user;
            $frontLicence = LoanDocument::whereLoanId($data->loan_id)->whereType(1)->first();
            $backLicence = LoanDocument::whereLoanId($data->loan_id)->whereType(2)->first();
            $addressProof = LoanDocument::whereLoanId($data->loan_id)->whereType(3)->first();
            $selfie = LoanDocument::whereLoanId($data->loan_id)->whereType(4)->first();
            if($frontLicence != null || $backLicence !=null  || $addressProof !=null || $selfie !=null){
                if($frontLicence->status == 1 && $backLicence->status == 1 && $addressProof->status == 1 && $selfie->status == 1){
                    $view = 'email.identity_verification_completed';
                    $templateSlug = config('constant.mail_template.6');
                    $this->helper->sendMailToUser($templateSlug,$view, $user,null,$data->loan);
                }
                if($frontLicence->status == 2 && $backLicence->status == 2 && $addressProof->status == 2 && $selfie->status == 2){
                    $view = 'email.identity_verification_rejected';
                    $templateSlug = config('constant.mail_template.7');
                    $this->helper->sendMailToUser($templateSlug,$view, $user,null,$data->loan);
                }
            }
            $msg = __('admin/messages.action_msg', ['action' => ($request->status==1)?__('admin/messages.approved'):__('admin/messages.reject'), 'type' => 'Document']);
            return response()->json(['msg' => $msg, 'icon' => 'success']);
        } catch (Exception $e) {
            $this->helper->dbRollBack();
            return response()->json(['msg' => $e->getMessage(), 'icon' => 'info']);
        }
    }

    public function export(Request $request){
        $fromDate = date('Y-m-d',strtotime($request->from_date. '-1 day'));
        $toDate = date('Y-m-d',strtotime($request->to_date. '+1 day'));
        $userLoanDetail = UserLoanDetail::whereBetween('created_at',[$fromDate,$toDate])->orderBy('created_at','desc')->get();
        if(isset($userLoanDetail) && count($userLoanDetail) > 0){
            return Excel::download(new LoanExport(@$userLoanDetail),'loan-user.xls');
        }else{
            return redirect()->route('loan.index')->with('error', __('formname.not_found'));
        }
    }

    public function getTransaction($uuid){
        $loanUser = $this->helper->detail($uuid);
        return view($this->viewConstant .'transactions',['loanUser'=>$loanUser]);
    }

    /**
     * -------------------------------------------------
     * | Get product category datatable data           |
     * |                                               |
     * | @param Request $request                       |
     * | @return View                                  |
     * |------------------------------------------------
     */
    public function getTransactionData($id=null)
    {
        try {
            $transactionList = LoanTransaction::whereLoanId($id)->get();
            return Datatables::of($transactionList)
                ->editColumn('created_at', function ($transaction) {
                    return @$transaction->proper_created_at;
                })
                ->addColumn('installment', function ($transaction) {
                    return @$transaction->month;
                })
                ->editColumn('date', function ($transaction) {
                    return $this->getPartials($this->viewConstant . '_add_input', ['id'=>@$transaction->id,'transaction' => @$transaction,'input'=>'date']);
                })
                ->editColumn('amount', function ($transaction) {
                    return $this->getPartials($this->viewConstant . '_add_input', ['id'=>@$transaction->id,'transaction' => @$transaction,'input'=>'amount']);
                })
                ->editColumn('loan_amount', function ($transaction) {
                    return @config('constant.currency_symbol').@$transaction->loanDetail->loan_amount;
                })
                ->rawColumns(['date','amount','created_at', 'loan_amount', 'action', 'status'])
                ->make(true);
        } catch (Exception $e) {
            abort('404');
        }
    }

    public function storeTransactionData(Request $request){
        $transaction = LoanTransaction::find($request->id);
        if($request->column == 'date' && $request->value != ''){
            array_set($request,'value',date('Y-m-d',strtotime($request->value)));
        }
        if($transaction){
            $transaction->update([$request->column=>$request->value]);
            $transaction = LoanTransaction::find($request->id);
            if($transaction->date != null && $transaction->amount != null){
                $view = 'email.loan_credited';
                $templateSlug = config('constant.mail_template.13');
                $this->helper->sendMailToUser($templateSlug,$view, @$transaction->user,null,@$transaction->loanDetail);
            }
            return response()->json(['icon'=>'success','msg'=>'record updated successfully']);
        }
        return response()->json(['icon'=>'info','msg'=>'record not found']);
    }

    public function userBankDetail($uuid){
        try{
            $title = 'Link Bank Detail';
            $statusList = $this->properStatusList();
            $loanStatusList = $this->loanStatusList();
            $loanDetail = $this->helper->detail($uuid);
            $account = BankAccount::where('loan_id',$loanDetail->id)->first();
            return view($this->viewConstant .'_bank_detail',['loanStatusList'=>@$loanStatusList,'statusList'=>$statusList,'uuid'=>$uuid,'title'=>@$title,'account'=>@$account,'loanDetail'=>@$loanDetail]);
        }catch(Exception $e){
            abort('501');
        }
    }

    public function storeAccountDetail(BankAccountFormRequest $request){
        $this->helper->dbStart();
        try {
            $account = $this->helper->storeAccountDetail($request);
            $user = @$account->user;
            if($account->status == 0){
                $view = 'email.bank_verification_under_process';
                $templateSlug = config('constant.mail_template.8');
                $this->helper->sendMailToUser($templateSlug,$view, $user,null,null);
            }
            if($account->status == 1){
                $view = 'email.bank_verification_completed';
                $templateSlug = config('constant.mail_template.9');
                $this->helper->sendMailToUser($templateSlug,$view, $user,null,null);
            }
            if($account->status == 2){
                $view = 'email.bank_verification_rejected';
                $templateSlug = config('constant.mail_template.10');
                $this->helper->sendMailToUser($templateSlug,$view, $user,null,@$account->loanDetail);
            }
            if ($request->has('id') && !empty($request->id)) {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.updated'), 'type' => 'Loan Account Detail']);
            } else {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.created'), 'type' => 'Loan Account Detail']);
            }
            $this->helper->dbEnd();
            return redirect()->route('loan.index')->with('message', $msg);
        }catch(Exception $e){
            $this->helper->dbRollBack();
            return Redirect::back()->with('error', $e->getMessage());
            abort('404');
        }
    }

    public function updateAccountStatus($uuid){
        $account = $this->helper->accountDetail($uuid);
        $user = @$account->user;
        $routeName = Route::currentRouteName();
        if($routeName == 'account.approve'){
            $account->update(['status'=>1]);
            $status = 1;
            $view = 'email.bank_verification_completed';
            $templateSlug = config('constant.mail_template.9');
            $this->helper->sendMailToUser($templateSlug,$view, $user,null,null);
        }else{
            $status = 2;
            $account->update(['status'=>2]);
            $view = 'email.bank_verification_rejected';
            $templateSlug = config('constant.mail_template.10');
            $this->helper->sendMailToUser($templateSlug,$view, $user,null,@$account->loanDetail);
        }
        $action = ($status == 1)?__('admin/messages.approved'):__('admin/messages.reject');
        // $this->sendNotification($account,$action,'1');
        $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.updated'), 'type' => 'Bank Account']);
        return redirect()->route('loan.index')->with('message', $msg);
    }   
}