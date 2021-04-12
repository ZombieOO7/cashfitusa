<?php
namespace App\Helpers;
use App\Models\Earning;
use App\Models\LoanDocument;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;

class WalletHelper extends BaseHelper
{

    protected $wallet;
    public function __construct(Wallet $wallet, User $user)
    {
        $this->wallet = $wallet;
        $this->user = $user;
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
        return $this->wallet::orderBy('id', 'desc');
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
        return $this->wallet::whereId($id)->first();
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
            $wallet = $this->wallet::whereUuid($request->id)->first();
        } else {
            $wallet = new Wallet();
        }
        $wallet->fill($request->all())->save();
        return $wallet;
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
        $wallet = $this->detail($uuid);
        if($wallet->status == 1){
            $status = 2;
        }else{
            $status = 1;
        }
        $action = ($status == 1)?__('admin/messages.approved'):__('admin/messages.reject');
        // $this->sendNotification($wallet,$action,'2');
        $this->wallet::where('uuid', $wallet->uuid)->update(['status' => $status]);
        $msg = __('admin/messages.action_msg', ['action' => $action, 'type' => 'Earning']);
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
        return $this->wallet::where('uuid', $uuid)->first();
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
        $wallet = $this->detail($uuid);
        $wallet->delete();
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
        $wallet = $this->wallet::whereIn('id', $request->ids);
        if ($request->action == config('constant.delete')) {
            $wallet->delete();
        } else {
            $status = $request->action == config('constant.inactive') ? config('constant.status_inactive_value') : config('constant.status_active_value');
            $wallet->update(['status' => $status]);
            $action = ($status == 1)?__('admin/messages.approved'):__('admin/messages.reject');
            $this->sendMultipleNotification($wallet->get(),$action,'2');
        }
    }

    /**
     * ------------------------------------------------------
     * | company detail by uuid                             |
     * |                                                    |
     * | @param $uuid                                       |
     * |-----------------------------------------------------
     */
    public function userDetail($uuid)
    {
        return $this->user::where('uuid', $uuid)->first();
    }
}
