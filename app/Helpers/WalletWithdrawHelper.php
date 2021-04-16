<?php
namespace App\Helpers;
use App\Models\Earning;
use App\Models\LoanDocument;
use App\Models\User;
use App\Models\Wallet;
use App\Models\BankTransaction;
use App\Models\WithdrawInfo;
use Illuminate\Http\Request;

class WalletWithdrawHelper extends BaseHelper
{

    protected $withdrawInfo;
    public function __construct(WithdrawInfo $withdrawInfo, User $user)
    {
        $this->withdrawInfo = $withdrawInfo;
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
        return $this->withdrawInfo::orderBy('id', 'desc');
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
        return $this->withdrawInfo::whereId($id)->first();
    }

    /**
     * ------------------------------------------------------
     * | company store                                      |
     * |                                                    |
     * | @param Request $request,$uuid                      |
     * |-----------------------------------------------------
     */
    public function store($request, $uuid = null)
    {
        array_set($request,'date',date('Y-m-d',strtotime($request->date)));
        if ($request->has('id') && $request->id != '') {
            $withdrawInfo = $this->withdrawInfo::whereUuid($request->id)->first();
        } else {
            $withdrawInfo = new BankTransaction();
        }
        $withdrawInfo->fill($request->all())->save();
        return $withdrawInfo;
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


        /**
     * ------------------------------------------------------
     * | faq detail by uuid                                 |
     * |                                                    |
     * | @param $uuid                                       |
     * |-----------------------------------------------------
     */
    public function detail($uuid)
    {
        return $this->withdrawInfo::where('uuid', $uuid)->first();
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
        $app = $this->withdrawInfo::whereIn('id', $request->ids);
        if ($request->action == config('constant.delete')) {
            $app->delete();
        } else {
            $status = $request->action == config('constant.inactive') ? config('constant.status_inactive_value') : config('constant.status_active_value');
            $app->update(['status' => $status]);
        }
    }
}
