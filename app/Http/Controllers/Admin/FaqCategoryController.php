<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Helpers\CompanyHelper;
use App\Helpers\FaqCategoryHelper;
use Yajra\Datatables\Datatables;
use App\Http\Requests\Admin\CompanyFormRequest;
use App\Http\Requests\Admin\FaqCategoryFormRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Redirect;

class FaqCategoryController extends BaseController
{
    private $helper, $user;
    public $viewConstant = 'admin.faq-category.';
    public function __construct(FaqCategoryHelper $helper, User $user)
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
            $categories = $this->helper->list();
            $categoryList = $categories->where(function ($query) use ($request) {
                if ($request->status) {
                    $query->activeSearch($request->status);
                }
            })->get();
            return Datatables::of($categoryList)
                ->addColumn('action', function ($category) {
                    return $this->getPartials($this->viewConstant . '_add_action', ['category' => $category]);
                })
                ->editColumn('status', function ($category) {
                    return $this->getPartials($this->viewConstant . '_add_status', ['category' => $category]);
                })
                ->editColumn('created_at', function ($category) {
                    return $category->proper_created_at;
                })
                ->addColumn('checkbox', function ($category) {
                    return $this->getPartials($this->viewConstant . '_add_checkbox', ['category' => $category]);
                })
                ->rawColumns(['created_at', 'checkbox', 'action', 'status'])
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
                $company = $this->helper->detail($uuid);
            }
            $statusList = $this->properStatusList();
            $title = isset($uuid) ? trans('formname.faq-category.update') : trans('formname.faq-category.create');
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
    public function store(FaqCategoryFormRequest $request, $uuid = null)
    {
        $this->helper->dbStart();
        try {
            $this->helper->store($request, $uuid);
            $this->helper->dbEnd();
            if ($request->has('id') && !empty($request->id)) {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.updated'), 'type' => 'Faq Category']);
            } else {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.created'), 'type' => 'Faq Category']);
            }
            return redirect()->route('faq-category.index')->with('message', $msg);
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
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.deleted'), 'type' => 'Faq Category']);
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
                $msg = __('admin/messages.action_msg', ['action' => $action, 'type' => 'Faq Category']);
                return response()->json(['msg' => $msg, 'icon' => 'success']);
            } else {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.deleted'), 'type' => 'Faq Category']);
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