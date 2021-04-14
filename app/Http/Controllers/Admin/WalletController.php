<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WalletHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AppFormRequest;
use App\Http\Requests\Admin\WalletFormRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class WalletController extends BaseController
{
    private $helper, $user;
    public $viewConstant = 'admin.wallet.';
    public function __construct(WalletHelper $helper, User $user)
    {
        $this->helper = $helper;
        $this->user = $user;
        $this->helper->mode = 'admin';
    }

    /**
     * -------------------------------------------------
     * | Create company page                           |
     * |                                               |
     * | @param $id                                    |
     * | @return View                                  |
     * |------------------------------------------------
     */
    public function create($uuid = null)
    {
        try {
            if (isset($uuid)) {
                $user = $this->helper->userDetail($uuid);
                if(isset($user->wallet) && $user->wallet != null){
                    $app = $user->wallet;
                }
            }
            $userList = $this->userList();
            $title = isset($uuid) ? trans('formname.wallet.update') : trans('formname.wallet.create');
            return view($this->viewConstant . 'create', ['app' => @$app, 'title' => @$title,'user' => @$user]);
        } catch (Exception $e) {
            abort(404);
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    /**
     * -------------------------------------------------
     * | Store comapny details                         |
     * |                                               |
     * | @param SubjectFormRequest $request            |
     * | @return View                                  |
     * |------------------------------------------------
     */
    public function store(WalletFormRequest $request, $uuid = null)
    {
        $this->helper->dbStart();
        try {
            $this->helper->store($request, $uuid);
            $this->helper->dbEnd();
            if ($request->has('id') && !empty($request->id)) {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.updated'), 'type' => 'Wallet']);
            } else {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.created'), 'type' => 'Wallet']);
            }
            return redirect()->route('user.index')->with('message', $msg);
        } catch (Exception $e) {
            $this->helper->dbRollBack();
            return Redirect::back()->with('error', $e->getMessage());
            abort('404');
        }
    }
}
