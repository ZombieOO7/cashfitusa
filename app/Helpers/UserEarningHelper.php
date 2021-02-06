<?php
namespace App\Helpers;

use App\Models\Earning;
use App\Models\LoanDocument;
use App\Models\UserEarning;
use Illuminate\Http\Request;

class UserEarningHelper extends BaseHelper
{

    protected $earning;
    public function __construct(UserEarning $earning)
    {
        $this->earning = $earning;
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
        return $this->earning::orderBy('id', 'desc');
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
        return $this->earning::whereId($id)->first();
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
            $earning = $this->earning::whereUuid($request->id)->first();
        } else {
            $earning = new UserEarning();
        }
        $earning->fill($request->all())->save();
        $status= ($earning->status == 1)?'Withdraw':'Credited';
        $action = config('constant.currency_symbol').$earning->amount.' '.$status.' on your account by '.$earning->app->title;
        $this->sendNotification($earning,$action,'3');
        return $earning;
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
        $earning = $this->detail($uuid);
        $status = ($earning->status==1)?0:1;
        $action = ($status == 1)?__('admin/messages.active'):__('admin/messages.inactive');
        $this->earning::where('uuid', $earning->uuid)->update(['status' => $status]);
        $msg = __('admin/messages.action_msg', ['action' => $action, 'type' => 'User Earning']);
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
        return $this->earning::where('uuid', $uuid)->first();
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
        $earning = $this->detail($uuid);
        $earning->delete();
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
        $earning = $this->earning::whereIn('id', $request->ids);
        if ($request->action == config('constant.delete')) {
            $earning->delete();
        } else {
            $status = $request->action == config('constant.inactive') ? config('constant.status_inactive_value') : config('constant.status_active_value');
            $earning->update(['status' => $status]);
        }
    }

}
