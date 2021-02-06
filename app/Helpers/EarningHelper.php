<?php
namespace App\Helpers;
use App\Models\Earning;
use App\Models\LoanDocument;
use Illuminate\Http\Request;

class EarningHelper extends BaseHelper
{

    protected $earning;
    public function __construct(Earning $earning)
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
            $earning = new Earning();
        }
        $earning->fill($request->all())->save();
        if ($request->hasFile('front_licence')){
            $this->storeImage($request, $earning,config('constant.earning.folder_name'),'front_licence',$request->front_licence);
        }
        if ($request->hasFile('back_licence')){
            $this->storeImage($request, $earning,config('constant.earning.folder_name'),'back_licence',$request->back_licence);
        }
        if ($request->hasFile('address_proof')){
            $this->storeImage($request, $earning,config('constant.earning.folder_name'),'address_proof',$request->address_proof);
        }
        if(isset($request->front_licence))
        {
            LoanDocument::whereName($request->front_licence)
                ->update(['earning_id'=>$earning->id,'type'=>1]);
        }
        if(isset($request->back_licence))
        {
            LoanDocument::whereName($request->back_licence)
                ->update(['earning_id'=>$earning->id,'type'=>2]);
        }
        if(isset($request->address_proof))
        {
            LoanDocument::whereName($request->address_proof)
                ->update(['earning_id'=>$earning->id,'type'=>3]);
        }
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
        if($earning->status == 0){
            $status = 1;
        }else if($earning->status == 1){
            $status = 2;
        }else{
            $status = 1;
        }
        $action = ($status == 1)?__('admin/messages.approved'):__('admin/messages.reject');
        $this->sendNotification($earning,$action,'2');
        $this->earning::where('uuid', $earning->uuid)->update(['status' => $status]);
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
            $action = ($status == 1)?__('admin/messages.approved'):__('admin/messages.reject');
            $this->sendMultipleNotification($earning->get(),$action,'2');
        }
    }

}
