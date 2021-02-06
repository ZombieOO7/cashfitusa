<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Helpers\LoanCategoryHelper;
use App\Helpers\WithdrawRequestHelper;
use Yajra\Datatables\Datatables;
use App\Http\Requests\Admin\CompanyFormRequest;
use App\Http\Requests\Admin\FaqCategoryFormRequest;
use App\Http\Requests\Admin\LoanCategoryFormRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Redirect;

class WithdrawRequestController extends BaseController
{
    private $helper, $user;
    public $viewConstant = 'admin.withdraw-request.';
    public function __construct(WithdrawRequestHelper $helper, User $user)
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
        // try {
            $withdraws = $this->helper->list();
            $withdrawList = $withdraws->where(function ($query) use ($request) {
                if($request->status != null){
                    $query->whereStatus($request->status);
                }
            })->get();
            return Datatables::of($withdrawList)
                ->addColumn('action', function ($withdraw) {
                    return $this->getPartials($this->viewConstant . '_add_action', ['withdraw' => $withdraw]);
                })
                ->editColumn('status', function ($withdraw) {
                    return $this->getPartials($this->viewConstant . '_add_status', ['withdraw' => $withdraw]);
                })
                ->editColumn('created_at', function ($withdraw) {
                    return $withdraw->proper_created_at;
                })
                ->editColumn('app_id', function ($earning) {
                    return @$earning->app->title;
                })
                ->editColumn('full_name', function ($earning) {
                    return @$earning->earningUser->full_name_text;
                })
                ->addColumn('checkbox', function ($withdraw) {
                    return $this->getPartials($this->viewConstant . '_add_checkbox', ['withdraw' => $withdraw]);
                })
                ->rawColumns(['created_at', 'checkbox', 'action', 'status'])
                ->make(true);
        // } catch (Exception $e) {
        //     abort('404');
        // }
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
                $company = $this->helper->detail($uuid);
            }
            $statusList = $this->properStatusList();
            $title = isset($uuid) ? trans('formname.loan-category.update') : trans('formname.loan-category.create');
            return view($this->viewConstant . 'create', ['company' => @$company, 'title' => @$title,'statusList' => @$statusList]);
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
    public function store(LoanCategoryFormRequest $request, $uuid = null)
    {
        $this->helper->dbStart();
        try {
            $this->helper->store($request, $uuid);
            $this->helper->dbEnd();
            if ($request->has('id') && !empty($request->id)) {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.updated'), 'type' => 'Loan Category']);
            } else {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.created'), 'type' => 'Loan Category']);
            }
            return redirect()->route('loan-category.index')->with('message', $msg);
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
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.deleted'), 'type' => 'Loan Category']);
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
            if ($request->action == config('constant.approve') || $request->action == config('constant.reject')) {
                $action = ($request->action == config('constant.approve'))?__('admin/messages.approved'):__('admin/messages.reject');
                $msg = __('admin/messages.action_msg', ['action' => $action, 'type' => 'Withdraw request']);
                return response()->json(['msg' => $msg, 'icon' => 'success']);
            } else {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.deleted'), 'type' => 'Withdraw request']);
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
        $company = $this->helper->detail($request->id);
        $counts = $this->user::whereCompanyId($company->id)->count();
        $msg = __('admin/messages.delete_data',['title'=>'Company','type'=>'user']);
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