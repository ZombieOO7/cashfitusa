<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\EarningHelper;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\Admin\AppFormRequest;
use App\Http\Requests\Admin\EarningFormRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Redirect;

class EarningController extends BaseController
{
    private $helper, $user;
    public $viewConstant = 'admin.earning.';
    public function __construct(EarningHelper $helper, User $user)
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
            $statusList = $this->loanStatusList();
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
            $earnings = $this->helper->list();
            $earningList = $earnings->where(function ($query) use ($request) {
                if ($request->status) {
                    $query->activeSearch($request->status);
                }
            })->get();
            return Datatables::of($earningList)
                ->addColumn('action', function ($earning) {
                    return $this->getPartials($this->viewConstant . '_add_action', ['earning' => $earning]);
                })
                ->editColumn('status', function ($earning) {
                    return $this->getPartials($this->viewConstant . '_add_status', ['earning' => $earning]);
                })
                ->editColumn('created_at', function ($earning) {
                    return @$earning->proper_created_at;
                })
                ->editColumn('app_id', function ($earning) {
                    return @$earning->app->title;
                })
                ->editColumn('user_id', function ($earning) {
                    return @$earning->user->email;
                })
                ->addColumn('checkbox', function ($earning) {
                    return $this->getPartials($this->viewConstant . '_add_checkbox', ['earning' => $earning]);
                })
                ->rawColumns(['app_id','user_id','created_at', 'checkbox', 'action', 'status'])
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
                $earning = $this->helper->detail($uuid);
            }
            $appList = $this->appList();
            $userList = $this->userList();
            $statusList = $this->loanStatusList();
            $title = isset($uuid) ? trans('formname.earning.update') : trans('formname.earning.create');
            return view($this->viewConstant . 'create', ['earning' => @$earning, 'title' => @$title,'statusList' => @$statusList,'appList'=>@$appList,'userList'=>@$userList]);
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
    public function store(EarningFormRequest $request, $uuid = null)
    {
        $this->helper->dbStart();
        try {
            $this->helper->store($request, $uuid);
            $this->helper->dbEnd();
            if ($request->has('id') && !empty($request->id)) {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.updated'), 'type' => 'Earning']);
            } else {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.created'), 'type' => 'Earning']);
            }
            return redirect()->route('earning.index')->with('message', $msg);
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
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.deleted'), 'type' => 'Earning']);
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
                // $action = ($request->action == config('constant.active'))?__('admin/messages.active'):__('admin/messages.inactive');
                $action = ($request->action == config('constant.approve'))?__('admin/messages.approved'):__('admin/messages.reject');
                $msg = __('admin/messages.action_msg', ['action' => $action, 'type' => 'Earning']);
                return response()->json(['msg' => $msg, 'icon' => 'success']);
            } else {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.deleted'), 'type' => 'Earning']);
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

    /**
     * -------------------------------------------------
     * | Before delete check company is used in users  |
     * |                                               |
     * | @param Request $request                       |
     * | @return Response                              |
     * |------------------------------------------------
     */
    public function jobStatus(Request $request){
        $app = $this->helper->detail($request->id);
        $counts = $this->user::whereCompanyId($app->id)->count();
        $msg = __('admin/messages.delete_data',['title'=>'app','type'=>'user']);
        return response()->json(['msg' => $msg, 'counts' => @$counts]);
    }
    /**
     * -------------------------------------------------
     * | Before delete check company is used in users  |
     * |                                               |
     * | @param Request $request                       |
     * | @return Response                              |
     * |------------------------------------------------
     */
    public function  multipleJobStatus(Request $request){
        $counts = $this->user::whereIn('company_id',$request->id)->count();
        $msg = __('admin/messages.multi_delete_data',['title'=>'Companies','type'=>'user(s)']);
        return response()->json(['msg' => $msg, 'counts' => @$counts]);
    }

}