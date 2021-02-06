<?php
namespace App\Helpers;
use App\Models\Company;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoryHelper extends BaseHelper
{

    protected $faqCategory;
    public function __construct(FaqCategory $faqCategory)
    {
        $this->faqCategory = $faqCategory;
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
        return $this->faqCategory::orderBy('id', 'desc');
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
        return $this->faqCategory::whereId($id)->first();
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
            $faqCategory = $this->faqCategory::findOrFail($request->id);
        } else {
            $faqCategory = new FaqCategory();
        }
        $faqCategory->fill($request->all())->save();
        if ($request->hasFile('image_file')): $this->storeImage($request, $faqCategory);
        endif;
        return $faqCategory;
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
        $faqCategory = $this->detail($uuid);
        $status = $faqCategory->status == config('constant.status_active_value') ? config('constant.status_inactive_value') : config('constant.status_active_value');
        $action = ($status == 1)?__('admin/messages.active'):__('admin/messages.inactive');
        $this->faqCategory::where('id', $faqCategory->id)->update(['status' => $status]);
        $msg = __('admin/messages.action_msg', ['action' => $action, 'type' => 'Company']);
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
        return $this->faqCategory::where('uuid', $uuid)->first();
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
        $faqCategory = $this->detail($uuid);
        $faqCategory->delete();
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
        $faqCategory = $this->faqCategory::whereIn('id', $request->ids);
        if ($request->action == config('constant.delete')) {
            $faqCategory->delete();
        } else {
            $status = $request->action == config('constant.inactive') ? config('constant.status_inactive_value') : config('constant.status_active_value');
            $faqCategory->update(['status' => $status]);
        }
    }

    /**
     * ------------------------------------------------------
     * | Store image                                        |
     * |                                                    |
     * | @param $request,$user                              |
     * |-----------------------------------------------------
     */
    public function storeImage($request, $faqCategory)
    {
        $folderName = config('constant.faqCategory.folder_name');
        if ($request->id != null):
            $this->deleteImage($faqCategory->path, $folderName);
            $this->deleteImage($faqCategory->thumb_path, $folderName);
        endif;
        $avatarImage = $request->file('image_file');
        $imageFunction = $this->uploadImage($request->file('image_file'), $folderName,240,320);
        $faqCategory = $this->faqCategory::updateOrCreate([
            'id' => $faqCategory->id,
        ], [
            'image' => @$imageFunction,
        ]);
        return $request;
    }
}
