<?php
namespace App\Helpers;
use App\Models\Company;
use App\Models\Earning;
use App\Models\FaqCategory;
use App\Models\LoanCategory;
use App\Models\UserEarning;
use App\Models\WithDrawRequest;
use Illuminate\Http\Request;

class WithdrawRequestHelper extends BaseHelper
{

    protected $withDrawRequest;
    public function __construct(WithDrawRequest $withDrawRequest)
    {
        $this->withDrawRequest = $withDrawRequest;
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
        return $this->withDrawRequest::orderBy('id', 'desc');
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
        return $this->withDrawRequest::whereId($id)->first();
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
            $withDrawRequest = $this->withDrawRequest::findOrFail($request->id);
        } else {
            $withDrawRequest = new LoanCategory();
        }
        $withDrawRequest->fill($request->all())->save();
        return $withDrawRequest;
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
        $withdraw = $this->detail($uuid);
        if($withdraw->status == 0){
            $status = 1;
        }else if($withdraw->status == 1){
            $status = 2;
        }else{
            $status = 1;
        }
        $action = ($status == 1)?__('admin/messages.approved'):__('admin/messages.reject');
        $this->withDrawRequest::where('uuid', $withdraw->uuid)->update(['status' => $status]);
        if($status ==1){
            $requestData = $this->withDrawRequest::where('uuid', $withdraw->uuid)->first();
            UserEarning::whereAppId($requestData->app_id)->whereHas('earningUser',function($query)use($requestData){
                            $query->whereUserId($requestData->earningUser->user_id);
                        })->update(['status'=>1]);
        }
        $this->sendNotification($withdraw,$action,3);
        $msg = __('admin/messages.action_msg', ['action' => $action, 'type' => 'Withdraw request']);
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
        return $this->withDrawRequest::where('uuid', $uuid)->first();
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
        $withDrawRequest = $this->detail($uuid);
        $withDrawRequest->delete();
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
        $withDrawRequest = $this->withDrawRequest::whereIn('id', $request->ids);
        if ($request->action == config('constant.delete')) {
            $withDrawRequest->delete();
        } else {
            $status = $request->action == config('constant.approve') ? config('constant.approve') : config('constant.reject');
            $withDrawRequest->update(['status' => $status]);
            $action = ($request->action == config('constant.approve'))?__('admin/messages.approved'):__('admin/messages.reject');
            $this->sendMultipleNotification($withDrawRequest->get(),$action,'3');
        }

    }
}
