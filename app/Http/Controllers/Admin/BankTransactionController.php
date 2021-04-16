<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CardTransactionHelper;
use App\Helpers\WalletTransactionHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WithdrawTransactionFormRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\DataTables;

class BankTransactionController extends BaseController
{
    private $helper, $user;
    public $viewConstant = 'admin.card-transaction.';
    public function __construct(CardTransactionHelper $helper, User $user)
    {
        $this->helper = $helper;
        $this->user = $user;
        $this->helper->mode = 'admin';
    }

        /**
     * -------------------------------------------------
     * | Display Comapny list                          |
     * |                                               |
     * | @return View                                  |
     * |------------------------------------------------
     */
    public function index()
    {
        try {
            $statusList = $this->statusList();
            return view($this->viewConstant . 'index', ['statusList' => @$statusList]);
        } catch (Exception $e) {
            abort(404);
        }
    }

    /**
     * -------------------------------------------------
     * | Get company datatable data                    |
     * |                                               |
     * | @param Request $request                       |
     * | @return View                                  |
     * |------------------------------------------------
     */
    public function getdata(Request $request)
    {
        try {
            $apps = $this->helper->list();
            $appList = $apps->where(function ($query) use ($request) {
                if ($request->status) {
                    $query->activeSearch($request->status);
                }
            })->get();
            return DataTables::of($appList)
                ->addColumn('action', function ($app) {
                    return $this->getPartials($this->viewConstant . '_add_action', ['app' => $app]);
                })
                ->editColumn('email', function ($app) {
                    return @$app->user->email;
                })
                ->editColumn('date', function ($app) {
                    return @$app->proper_date;
                })
                ->addColumn('checkbox', function ($app) {
                    return $this->getPartials($this->viewConstant . '_add_checkbox', ['app' => $app]);
                })
                ->rawColumns(['created_at', 'checkbox','email', 'action', 'amount','date'])
                ->make(true);
        } catch (Exception $e) {
            abort('404');
        }
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
                $app = $this->helper->detail($uuid);
            }
            $statusList = $this->properStatusList();
            $userList = $this->userList();
            $title = isset($uuid) ? trans('formname.card-transaction.update') : trans('formname.card-transaction.create');
            return view($this->viewConstant . 'create', ['userList'=>@$userList,'app' => @$app, 'title' => @$title,'statusList' => @$statusList]);
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
public function store(WithdrawTransactionFormRequest $request, $uuid = null)
    {
        $this->helper->dbStart();
        try {
            $this->helper->store($request, $uuid);
            $this->helper->dbEnd();
            if ($request->has('id') && !empty($request->id)) {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.updated'), 'type' => 'Card Transaction']);
            } else {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.created'), 'type' => 'Card Transaction']);
            }
            return redirect()->route('card-transaction.index')->with('message', $msg);
        } catch (Exception $e) {
            $this->helper->dbRollBack();
            return Redirect::back()->with('error', $e->getMessage());
            abort('404');
        }
    }
    /**
     * -------------------------------------------------
     * | Delete company details                        |
     * |                                               |
     * | @param Request $request                       |
     * | @return Response                              |
     * |------------------------------------------------
     */
    public function destroy(Request $request)
    {
        $this->helper->dbStart();
        try{
            if (isset($request->id)) {
                $this->helper->delete($request->id);
                $this->helper->dbEnd();
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.deleted'), 'type' => 'Card Transaction']);
                return response()->json(['msg' => $msg, 'icon' => 'success']);
            }else {
                return response()->json(['msg' => Lang::get('formname.not_found'), 'icon' => 'info']);
            }
        } catch (Exception $e) {
            $this->helper->dbRollBack();
            return response()->json(['msg' => $e->getMessage(), 'icon' => 'info']);
        }
    }
    /**
     * -------------------------------------------------
     * | Delete multiple company                       |
     * |                                               |
     * | @param Request $request                       |
     * | @return Response                              |
     * |------------------------------------------------
     */
    public function multidelete(Request $request)
    {
        $this->helper->dbStart();
        try{
            $this->helper->multiDelete($request);
            $this->helper->dbEnd();
            if ($request->action == config('constant.inactive') || $request->action == config('constant.active')) {
                $action = ($request->action == config('constant.active'))?__('admin/messages.active'):__('admin/messages.inactive');
                $msg = __('admin/messages.action_msg', ['action' => $action, 'type' => 'Card Transaction']);
                return response()->json(['msg' => $msg, 'icon' => 'success']);
            } else {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.deleted'), 'type' => 'Card Transaction']);
                return response()->json(['msg' => @$msg, 'icon' => 'success']);
            }
        } catch (Exception $e) {
            $this->helper->dbRollBack();
            return response()->json(['msg' => $e->getMessage(), 'icon' => 'info']);
        }
    }
    /**
     * -------------------------------------------------
     * | Update company status details                 |
     * |                                               |
     * | @param Request $request                       |
     * | @return View                                  |
     * |------------------------------------------------
     */
    public function updateStatus(Request $request)
    {
        $this->helper->dbStart();
        try{
            if (isset($request->id)) {
                $msg = $this->helper->statusUpdate($request->id);
                $this->helper->dbEnd();
                return response()->json(['msg' => $msg, 'icon' => 'success']);
            } else {
                return response()->json(['msg' => __('admin/messages.not_found'), 'icon' => 'info']);
            }
        } catch (Exception $e) {
            $this->helper->dbRollBack();
            return response()->json(['msg' => $e->getMessage(), 'icon' => 'info']);
        }
    }    
}
