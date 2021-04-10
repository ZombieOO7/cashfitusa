<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\BaseHelper;
use App\Helpers\LoanHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LoanDocument;
use App\Models\UserLoanDetail;
use Exception;
use Illuminate\Support\Facades\Redirect;

class AccountController extends BaseController
{
    public $viewConstant = 'frontend.loan.';
    public $helper,$baseHelper;
    public function __construct(BaseHelper $baseHelper,LoanHelper $helper)
    {
        $this->baseHelper = $baseHelper;
        $this->helper = $helper;
    }

    public function verificationCompleted($id=null){
        return view('frontend.verification_completed',['title'=>'Verification Completed','id'=>$id]);
    }

    public function verificationRejected($id=null){
        return view('frontend.verification_rejected',['title'=>'Verification Rejected','id'=>$id]);
    }

    public function verificationUnderProcess(){
        return view('frontend.verification_under_process',['title'=>'Verification Under Process']);
    }

    public function linkBank($id=null){
        $loanDetail = $this->helper->detail($id);
        $accountDetail = $loanDetail->bankAccount;
        if($accountDetail != null && $accountDetail->status != 2){
            return redirect()->route('account-verification',['id'=>@$loanDetail->uuid]);
        }
        return view('frontend.link_bank',['title'=>'Link Your Bank','loanDetail'=>@$loanDetail,'account'=>@$accountDetail]);
    }

    public function storeAccountDetail(Request $request){
        $this->helper->dbStart();
        try {
            $account = $this->helper->storeAccountDetail($request);
            $loanDetail = $account->loanDetail;
            if ($request->has('id') && !empty($request->id)) {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.updated'), 'type' => 'Loan Account Detail']);
            } else {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.created'), 'type' => 'Loan Account Detail']);
            }
            $this->helper->dbEnd();
            return redirect()->route('account-verification',['id'=>@$loanDetail->uuid])->with('message', $msg);
        }catch(Exception $e){
            $this->helper->dbRollBack();
            return Redirect::back()->with('error', $e->getMessage());
            abort('404');
        }
    }

    public function bankAccountVerification($uuid=null){
        $loanDetail = $this->helper->detail($uuid);
        $bankAccountDetail = $loanDetail->bankAccount;
        if($bankAccountDetail){
            if($bankAccountDetail->status==0){
                return view('frontend.verification_under_process',['title'=>'Verification Under Process']);
            }elseif($bankAccountDetail->status==1){
                return view('frontend.verification_completed',['title'=>'Identity Verification Completed']);
            }else{
                return view('frontend.verification_rejected',['title'=>'Identy Verification Rejected','id'=>$loanDetail->uuid]);
            }
        }
        return redirect()->route('link.bank',['id'=>$loanDetail->uuid]);
    }

    public function documentVerification($uuid=null){
        $userLoanDetail = UserLoanDetail::whereUuid($uuid)->first();
        $loanDocuments = LoanDocument::whereLoanId($userLoanDetail->id)->first();
        $frontLicence = LoanDocument::whereLoanId($userLoanDetail->id)->whereType(1)->first();
        $backLicence = LoanDocument::whereLoanId($userLoanDetail->id)->whereType(2)->first();
        $addressProof = LoanDocument::whereLoanId($userLoanDetail->id)->whereType(3)->first();
        $selfie = LoanDocument::whereLoanId($userLoanDetail->id)->whereType(4)->first();
        if($frontLicence != null || $backLicence !=null  || $addressProof !=null || $selfie !=null){
            if(@$frontLicence->status == 0 || @$backLicence->status == 0 || @$addressProof->status == 0 || @$selfie->status == 0){
                return view('frontend.identy_verification_under_process',['title'=>'Identy Verification Under Process']);
            }
            if($frontLicence->status == 2 || $backLicence->status == 2 || $addressProof->status == 2 || $selfie->status == 2){
                return view('frontend.identy_verification_rejected',['title'=>'Verification Rejected','id'=>@$userLoanDetail->uuid]);
            }
            if($frontLicence->status == 1 || $backLicence->status == 1 || $addressProof->status == 1 || $selfie->status == 1){
                return view('frontend.identy_verification_completed',['title'=>'Verification Completed','id'=>@$userLoanDetail->uuid]);
            }
        }
    }
}
