<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use View;
use App\Models\FaqCategory;
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
     * combile key and value
     * @return Array
     */
    public function combineValues($a,$type)
    {
        return  ['' => __('formname.select_type',['type'=>@$type])]+array_combine($a,$a);
    }

    /**
     * Show faq category dropdown
     * @return Array
     */
    public function faqCategoryList(){
        $faqCategory = FaqCategory::pluck('title','id');
        return $this->mergeSelectOption($faqCategory->toArray(),'Category');
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

    /**
     * Show account type dropdown
     * @return Array
     */
    public function accountTypeList(){
        $typeList = config('constant.account_type');
        return ['' => 'Type of account *']+$typeList;
        // return $this->mergeSelectOption($typeList,'Account Type');
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
