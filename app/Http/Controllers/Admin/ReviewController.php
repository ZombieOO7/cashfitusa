<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Helpers\CompanyHelper;
use App\Helpers\ReviewHelper;
use Yajra\Datatables\Datatables;
use App\Http\Requests\Admin\CompanyFormRequest;
use App\Http\Requests\Admin\FaqCategoryFormRequest;
use App\Http\Requests\Admin\ReviewFormRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Redirect;

class ReviewController extends BaseController
{
    private $helper, $user;
    public $viewConstant = 'admin.review.';
    public function __construct(ReviewHelper $helper, User $user)
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
        // try {
            $statusList = $this->statusList();
            return view($this->viewConstant . 'index', ['statusList' => @$statusList]);
        // } catch (Exception $e) {
        //     abort(404);
        // }
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
            $reviews = $this->helper->list();
            $reviewList = $reviews->where(function ($query) use ($request) {
                if ($request->status) {
                    $query->activeSearch($request->status);
                }
            })->get();
            return Datatables::of($reviewList)
                ->addColumn('action', function ($review) {
                    return $this->getPartials($this->viewConstant . '_add_action', ['review' => $review]);
                })
                ->editColumn('status', function ($review) {
                    return $this->getPartials($this->viewConstant . '_add_status', ['review' => $review]);
                })
                ->editColumn('created_at', function ($review) {
                    return $review->proper_created_at;
                })
                ->addColumn('checkbox', function ($review) {
                    return $this->getPartials($this->viewConstant . '_add_checkbox', ['review' => $review]);
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
                $review = $this->helper->detail($uuid);
            }
            $statusList = $this->properStatusList();
            $title = isset($uuid) ? trans('formname.review.update') : trans('formname.review.create');
            return view($this->viewConstant . 'create', ['review' => @$review, 'title' => @$title,'statusList' => @$statusList]);
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
    public function store(ReviewFormRequest $request, $uuid = null)
    {
        $this->helper->dbStart();
        try {
            $this->helper->store($request, $uuid);
            $this->helper->dbEnd();
            if ($request->has('id') && !empty($request->id)) {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.updated'), 'type' => 'Review']);
            } else {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.created'), 'type' => 'Review']);
            }
            return redirect()->route('review.index')->with('message', $msg);
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
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.deleted'), 'type' => 'Review']);
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
                $msg = __('admin/messages.action_msg', ['action' => $action, 'type' => 'Review']);
                return response()->json(['msg' => $msg, 'icon' => 'success']);
            } else {
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.deleted'), 'type' => 'Review']);
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