<?php
namespace App\Helpers;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserHelper extends BaseHelper
{

    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
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
        return $this->user::orderBy('id', 'desc');
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
        return $this->user::whereId($id)->first();
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
            $user = $this->user::findOrFail($request->id);
        } else {
            $user = new User();
        }
        if($request->password != null){
            $request['password']=Hash::make($request->password);
        }else{
            $request->request->remove('password');
        }
        if ($request->hasFile('image_file')) {
            $logo = $request->file('image_file');
            $request['image'] = $this->fileupload($logo, ($user->image) ? $user->image : null);
        }
        $user->fill($request->all())->save();
        return $user;
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
        $user = $this->detail($uuid);
        $status = $user->status == config('constant.status_active_value') ? config('constant.status_inactive_value') : config('constant.status_active_value');
        $action = ($status == 1)?__('admin/messages.active'):__('admin/messages.inactive');
        $this->user::where('id', $user->id)->update(['status' => $status]);
        $msg = __('admin/messages.action_msg', ['action' => $action, 'type' => 'User']);
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
        return $this->user::where('uuid', $uuid)->first();
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
        $user = $this->detail($uuid);
        $user->delete();
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
        $user = $this->user::whereIn('id', $request->ids);
        if ($request->action == config('constant.delete')) {
            $user->delete();
        } else {
            $status = $request->action == config('constant.inactive') ? config('constant.status_inactive_value') : config('constant.status_active_value');
            $user->update(['status' => $status]);
        }
    }
    public function fileupload($file, $name = null)
    {
        if ($name != null) {
            Storage::disk('local')->delete('users/' . $name);
        }
        $filename = time() . '_' . $file->getClientOriginalName();
        Storage::disk('local')->putFileAs('users/', $file, $filename);
        return $filename;
    }
}
