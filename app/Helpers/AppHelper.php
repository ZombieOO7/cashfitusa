<?php

namespace App\Helpers;

use App\Models\App;
use App\Models\Faq;
use Illuminate\Http\Request;

class AppHelper extends BaseHelper
{

    protected $app;
    public function __construct(App $app)
    {
        $this->app = $app;
        parent::__construct();
    }
    /**
     * ------------------------------------------------------
     * | Get faq list                                       |
     * |                                                    |
     * |-----------------------------------------------------
     */
    public function list()
    {
        return $this->app::orderBy('id', 'desc');
    }

    /**
     * ------------------------------------------------------
     * | faq detail by id                                   |
     * |                                                    |
     * | @param $id                                         |
     * |-----------------------------------------------------
     */
    public function detailById($id)
    {
        return $this->app::whereId($id)->first();
    }

    /**
     * ------------------------------------------------------
     * | faq store                                          |
     * |                                                    |
     * | @param Request $request,$uuid                      |
     * |-----------------------------------------------------
     */
    public function store(Request $request, $uuid = null)
    {
        if ($request->has('id') && $request->id != '') {
            $app = $this->app::findOrFail($request->id);
        } else {
            $app = new App();
        }
        $app->fill($request->all())->save();
        if ($request->hasFile('image_file')): $this->storeImage($request, $app,config('constant.app.folder_name'),'image',$request->image_file);
        endif;
        if ($request->hasFile('video_file')): $this->storeImage($request, $app,config('constant.app.folder_name'),'video',$request->video_file);
        endif;
        return $app;
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
        $app = $this->detail($uuid);
        $status = $app->status == config('constant.status_active_value') ? config('constant.status_inactive_value') : config('constant.status_active_value');
        $action = ($status == 1)?__('admin/messages.active'):__('admin/messages.inactive');
        $this->app::where('id', $app->id)->update(['status' => $status]);
        $msg = __('admin/messages.action_msg', ['action' => $action, 'type' => 'App']);
        return $msg;
    }

    /**
     * ------------------------------------------------------
     * | faq detail by uuid                                 |
     * |                                                    |
     * | @param $uuid                                       |
     * |-----------------------------------------------------
     */
    public function detail($uuid)
    {
        return $this->app::where('uuid', $uuid)->first();
    }

    /**
     * ------------------------------------------------------
     * | Delete faq                                         |
     * |                                                    |
     * | @param $uuid                                       |
     * |-----------------------------------------------------
     */
    public function delete($uuid)
    {
        $app = $this->detail($uuid);
        $app->delete();
    }

    /**
     * ---------------------------------------------------------------
     * | Delete multiple faq                                         |
     * |                                                             |
     * | @param Request $request                                     |
     * | @return Void                                                |
     * ---------------------------------------------------------------
     */
    public function multiDelete(Request $request)
    {
        $app = $this->app::whereIn('id', $request->ids);
        if ($request->action == config('constant.delete')) {
            $app->delete();
        } else {
            $status = $request->action == config('constant.inactive') ? config('constant.status_inactive_value') : config('constant.status_active_value');
            $app->update(['status' => $status]);
        }
    }
}
