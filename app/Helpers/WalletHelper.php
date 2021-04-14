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
