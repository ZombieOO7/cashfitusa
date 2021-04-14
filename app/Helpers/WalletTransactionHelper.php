<?php
namespace App\Helpers;
use App\Models\Earning;
use App\Models\LoanDocument;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WithdrawTransaction;
use Illuminate\Http\Request;

class WalletTransactionHelper extends BaseHelper
{

    protected $transaction;
    public function __construct(WithdrawTransaction $transaction, User $user)
    {
        $this->transaction = $transaction;
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
        return $this->transaction::orderBy('id', 'desc');
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
        return $this->transaction::whereId($id)->first();
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
            $transaction = $this->transaction::whereUuid($request->id)->first();
        } else {
            $transaction = new WithdrawTransaction();
        }
        $transaction->fill($request->all())->save();
        return $transaction;
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
        return $this->transaction::where('uuid', $uuid)->first();
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
        $app = $this->transaction::whereIn('id', $request->ids);
        if ($request->action == config('constant.delete')) {
            $app->delete();
        } else {
            $status = $request->action == config('constant.inactive') ? config('constant.status_inactive_value') : config('constant.status_active_value');
            $app->update(['status' => $status]);
        }
    }
}
