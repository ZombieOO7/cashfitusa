<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\App;
use View;
use App\Models\Company;
use App\Models\FaqCategory;
use App\Models\Job;
use App\Models\JobStatus;
use App\Models\LoanNotification;
use App\Models\Location;
use App\Models\Machine;
use App\Models\Notification;
use App\Models\Problem;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BaseController extends Controller
{
    public $blankObject;

    public function __construct()
    {
        $this->blankObject = (object) [];
    }

    /**
     * Show status dropdown
     * @return Array
     */
    public function statusList()
    {
        return [
            '' => 'Select Status',
            'Active' => 'Active',
            'Inactive' => 'Inactive',
        ];
    }
    /**
     * add select option in dropdown
     * @return Array
     */
    public function mergeSelectOption($a,$type)
    {
        return  ['' => __('formname.select_type',['type'=>@$type])]+$a;
    }

    /**
     * partial view
     * @return View
     */
    public function getPartials($blade,$review){
        return View::make($blade, $review)->render();
    }


    /**
     * Show status dropdown
     * @return Array
     */
    public function properStatusList()
    {
        return $this->mergeSelectOption([
            0 => 'Inactive',
            1 => 'Active',
        ],'status');
    }

        /**
     * Show status dropdown
     * @return Array
     */
    public function loanStatusList()
    {
        return $this->mergeSelectOption([
            0 => 'Pending',
            1 => 'Approve',
            2 => 'Reject',
        ],'status');
    }


    /**
     * combile key and value
     * @return Array
     */
    public function combineValues($a,$type)
    {
        return  ['' => __('formname.select_type',['type'=>@$type])]+array_combine($a,$a);
    }


    public function faqCategoryList(){
        $faqCategory = FaqCategory::pluck('title','id');
        return $this->mergeSelectOption($faqCategory->toArray(),'Category');
    }

        /*
     * -------------------------------------------------------
     * | Begine Transaction.                                 |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function dbStart()
    {
        return DB::beginTransaction();
    }

    /*
     * -------------------------------------------------------
     * | Commit Transaction.                                 |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function dbCommit()
    {
        return DB::commit();
    }

    /**
     * -------------------------------------------------------
     * | RollBack Transaction.                               |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function dbEnd()
    {
        return DB::rollback();
    }

    /**
     * -------------------------------------------------------
     * | RollBack Transaction.                               |
     * |                                                     |
     * -------------------------------------------------------
     */
    public function dbRollBack()
    {
        return DB::rollback();
    }

    /**
     * -------------------------------------------------------
     * | Upload Image Code                                   |
     * |                                                     |
     * | @param  string $mainFolderName                      |
     * | @param  string $folderName                          |
     * | @param  string $image                               |
     * | @return string                                      |
     * -------------------------------------------------------
     */
    public function uploadImage($file,$folderName,$width=null,$height=null)
    {
        $image = $file;
        $fileName   = time() . '.' . $image->getClientOriginalExtension();
        $newFileName = Storage::disk('local')->put($folderName, $image, 'public');
        $fileName = pathinfo($newFileName, PATHINFO_FILENAME) . '.' . pathinfo($newFileName, PATHINFO_EXTENSION);
        return $fileName;
    }

    public function userList(){
        $users = User::pluck('email','id');
        return $this->mergeSelectOption($users->toArray(),'Users');
    }

    public function appList(){
        $apps = App::pluck('title','id');
        return $this->mergeSelectOption($apps->toArray(),'apps');
    }
    /**
     * Show residency year dropdown
     * @return Array
     */
    public function yearList(){
        $yearList = config('constant.residency_year');
        return ['' => 'Residing Since']+$yearList;
        // return $this->mergeSelectOption($yearList,'year');
    }

    /**
     * Show account type dropdown
     * @return Array
     */
    public function accountTypeList(){
        $typeList = config('constant.account_type');
        return ['' => 'Type of account']+$typeList;
        // return $this->mergeSelectOption($typeList,'Account Type');
    }

    public function sendNotification($docData,$status,$type, $docType=null){
        if($docType && $type ==1){
            $data = $docData->loan;
            $detail['loan_document_id'] = $docData->id;
            $detail['content']= 'your '.$docType.' has been '.strtolower($status).' for '. config('constant.currency_symbol').$data->loan_amount .' loan application';
        }else{
            $data = $docData;
            $detail['loan_detail_id'] = $data->id;
            $detail['content']= 'your loan application of '. config('constant.currency_symbol').$data->loan_amount .' has been '.strtolower($status);
        }
        $notification = new LoanNotification();
        $detail['user_id']=$data->user_id;
        $detail['type'] =$type;
        $notification->create($detail);
    }

    public function sendMultipleNotification($datas,$status,$type){
        foreach($datas as $key => $data){
            $notification = new LoanNotification();
            $detail['type'] =$type;
            $detail['user_id']=$data->user_id;
            if($type == 1){
                $detail['content']= 'your loan application of '. config('constant.currency_symbol').$data->loan_amount .' has been '.strtolower($status);
                $detail['loan_detail_id'] = $data->id;
            }
            $notification->create($detail);
        }
    }

    public function earningStatus(){
        return $this->mergeSelectOption([
            0 => 'Credit',
            1 => 'Withdraw',
        ],'status');        
    }

    /**
     * Show loan type dropdown
     * @return Array
     */
    public function loanTypes(){
        $typeList = config('constant.loan_type');
        return ['' => 'Loan Type *']+$typeList;
        // return $this->mergeSelectOption($typeList,'Account Type');
    }

}
