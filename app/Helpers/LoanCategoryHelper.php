<?php
namespace App\Helpers;
use App\Models\Company;
use App\Models\FaqCategory;
use App\Models\LoanCategory;
use Illuminate\Http\Request;

class LoanCategoryHelper extends BaseHelper
{

    protected $loanCategory;
    public function __construct(LoanCategory $loanCategory)
    {
        $this->loanCategory = $loanCategory;
        parent::__construct();
    }
    /**
     * ------------------------------------------------------
     * | Get company list                                   |
     * |                                                    |
     * |-----------------------------------------------------
     */
    public function list()
    {
        return $this->loanCategory::orderBy('id', 'desc');
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
        return $this->loanCategory::whereId($id)->first();
    }

    /**
     * ------------------------------------------------------
     * | company store                                      |
     * |                                                    |
     * | @param Request $request,$uuid                      |
     * |-----------------------------------------------------
     */
    public function store(Request $request, $uuid = null)
    {
        if ($request->has('id') && $request->id != '') {
            $loanCategory = $this->loanCategory::findOrFail($request->id);
        } else {
            $loanCategory = new LoanCategory();
        }
        $loanCategory->fill($request->all())->save();
        // if ($request->hasFile('image_file')): $this->storeImage($request, $loanCategory);
        // endif;
        return $loanCategory;
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
        $loanCategory = $this->detail($uuid);
        $status = $loanCategory->status == config('constant.status_active_value') ? config('constant.status_inactive_value') : config('constant.status_active_value');
        $action = ($status == 1)?__('admin/messages.active'):__('admin/messages.inactive');
        $this->loanCategory::where('id', $loanCategory->id)->update(['status' => $status]);
        $msg = __('admin/messages.action_msg', ['action' => $action, 'type' => 'Loan Category']);
        return $msg;
    }

    /**
     * ------------------------------------------------------
     * | company detail by uuid                             |
     * |                                                    |
     * | @param $uuid                                       |
     * |-----------------------------------------------------
     */
    public function detail($uuid)
    {
        return $this->loanCategory::where('uuid', $uuid)->first();
    }

    /**
     * ------------------------------------------------------
     * | Delete company                                     |
     * |                                                    |
     * | @param $uuid                                       |
     * |-----------------------------------------------------
     */
    public function delete($uuid)
    {
        $loanCategory = $this->detail($uuid);
        $loanCategory->delete();
    }

    /**
     * ---------------------------------------------------------------
     * | Delete multiple company                                     |
     * |                                                             |
     * | @param Request $request                                     |
     * | @return Void                                                |
     * ---------------------------------------------------------------
     */
    public function multiDelete(Request $request)
    {
        $loanCategory = $this->loanCategory::whereIn('id', $request->ids);
        if ($request->action == config('constant.delete')) {
            $loanCategory->delete();
        } else {
            $status = $request->action == config('constant.inactive') ? config('constant.status_inactive_value') : config('constant.status_active_value');
            $loanCategory->update(['status' => $status]);
        }
    }

    /**
     * ------------------------------------------------------
     * | Store image                                        |
     * |                                                    |
     * | @param $request,$user                              |
     * |-----------------------------------------------------
     */
    public function storeImage($request, $loanCategory)
    {
        $folderName = config('constant.faqCategory.folder_name');
        if ($request->id != null):
            $this->deleteImage($loanCategory->path, $folderName);
            $this->deleteImage($loanCategory->thumb_path, $folderName);
        endif;
        $avatarImage = $request->file('image_file');
        $imageFunction = $this->uploadImage($request->file('image_file'), $folderName,240,320);
        $loanCategory = $this->loanCategory::updateOrCreate([
            'id' => $loanCategory->id,
        ], [
            'image' => @$imageFunction,
        ]);
        return $request;
    }
}
