<?php
namespace App\Helpers;

use App\Models\LoanDocument;
use App\Models\LoanTransaction;
use App\Models\ProductCategory;
use App\Models\User;
use App\Models\UserLoanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoanHelper extends BaseHelper
{

    protected $loan;
    public function __construct(UserLoanDetail $loan)
    {
        $this->loan = $loan;
        parent::__construct();
    }
    /**
     * ------------------------------------------------------
     * | Get product category list                          |
     * |                                                    |
     * |-----------------------------------------------------
     */
    public function list()
    {
        return $this->loan::orderBy('id', 'desc');
    }

    /**
     * ------------------------------------------------------
     * | comapny detail by id                               |
     * |                                                    |
     * | @param $id                                         |
     * |-----------------------------------------------------
     */
    public function detailById($id)
    {
        return $this->loan::whereId($id)->first();
    }

    /**
     * ------------------------------------------------------
     * | product category store                             |
     * |                                                    |
     * | @param Request $request,$uuid                      |
     * |-----------------------------------------------------
     */
    public function store(Request $request, $uuid = null)
    {
        if ($request->has('id') && $request->id != '') {
            $loan = $this->loan::whereUuid($request->id)->first();
        } else {
            $loan = new UserLoanDetail();
            // $autoAccountNo = generateStudentNo();
            // array_set($request,'auto_account_number',$autoAccountNo);
        }
        array_set($request,'dob',date('Y-m-d',strtotime($request->dob)));
        $loan->fill($request->all())->save();
        if(count($loan->transactions) == 0){
            $transactionData = [];
            for($i=1; $i <= $request->months; $i++){
                $transactionData[$i]['month'] = $i;
                $transactionData[$i]['loan_id'] = $loan->id;
                $transactionData[$i]['user_id'] = $loan->user_id;
            }
            LoanTransaction::insert($transactionData);
        }
        $data['loan_id'] = $loan->id;
        $data['status'] = 1;
        if ($request->hasFile('front_licence')){
            $data['name'] = $this->storeDocImage($request->front_licence, $loan);
            LoanDocument::updateOrCreate(['loan_id'=>$loan->id,'type'=>1,],$data);
        }
        if($request->hasFile('back_licence')){
            $data['name'] = $this->storeDocImage($request->back_licence, $loan);
            LoanDocument::updateOrCreate(['loan_id'=>$loan->id,'type'=>2,],$data);
        }
        if($request->hasFile('address_proof')){
            $data['name'] = $this->storeDocImage($request->address_proof, $loan);
            LoanDocument::updateOrCreate(['loan_id'=>$loan->id,'type'=>3,],$data);
        }
        if($request->hasFile('selfie')){
            $data['name'] = $this->storeDocImage($request->selfie, $loan);
            LoanDocument::updateOrCreate(['loan_id'=>$loan->id,'type'=>4,],$data);
        }
        return $loan;
    }

    /**
     * ------------------------------------------------------
     * | Update status                                      |
     * |                                                    |
     * | @param $uuid                                       |
     * |-----------------------------------------------------
     */
    public function statusUpdate($uuid)
    {
        $loan = $this->detail($uuid);
        if($loan->status == 0){
            $status = 1;
        }else if($loan->status == 1){
            $status = 2;
        }else{
            $status = 1;
        }
        $action = ($status == 1)?__('admin/messages.approved'):__('admin/messages.reject');
        $this->loan::where('uuid', $loan->uuid)->update(['status' => $status]);
        $msg = __('admin/messages.action_msg', ['action' => $action, 'type' => 'Loan']);
        $this->sendNotification($loan,$action,'1');
        return $msg;
    }

    /**
     * ------------------------------------------------------
     * | product category detail by uuid                    |
     * |                                                    |
     * | @param $uuid                                       |
     * |-----------------------------------------------------
     */
    public function detail($uuid)
    {
        return $this->loan::where('uuid', $uuid)->first();
    }

    /**
     * ------------------------------------------------------
     * | Delete product category                            |
     * |                                                    |
     * | @param $uuid                                       |
     * |-----------------------------------------------------
     */
    public function delete($uuid)
    {
        $loan = $this->detail($uuid);
        $loan->delete();
    }

    /**
     * ---------------------------------------------------------------
     * | Delete multiple product category                            |
     * |                                                             |
     * | @param Request $request                                     |
     * | @return Void                                                |
     * ---------------------------------------------------------------
     */
    public function multiDelete(Request $request)
    {
        $loan = $this->loan::whereIn('id', $request->ids);
        if ($request->action == config('constant.delete')) {
            $loan->delete();
        } else {
            $status = $request->action == config('constant.approve') ? config('constant.approve') : config('constant.reject');
            $loan->update(['status' => $status]);
            $action = ($request->action == config('constant.approve'))?__('admin/messages.approved'):__('admin/messages.reject');
            $this->sendMultipleNotification($loan->get(),$action,'1');
        }
    }

    /**
     * ------------------------------------------------------
     * | Store image                                        |
     * |                                                    |
     * | @param $request,$user                              |
     * |-----------------------------------------------------
     */
    public function storeDocImage($request, $user)
    {
        $folderName = 'loan-'.$user->id;
        $imageFunction = $this->uploadImage($request, $folderName,240,320);
        return @$imageFunction;
    }

}
