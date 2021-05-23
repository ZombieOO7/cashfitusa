<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Helpers\UserHelper;
use Yajra\Datatables\Datatables;
use App\Http\Requests\Admin\ProductCategoryFormRequest;
use App\Http\Requests\Admin\UserFormRequest;
use App\Models\User;
use App\Models\UserDocument;
use App\Models\UserLoanDetail;
use App\Models\ProceedData;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends BaseController
{
    private $helper, $user;
    public $viewConstant = 'admin.user.';
    public function __construct(UserHelper $helper, User $user)
    {
        $this->helper = $helper;
        $this->user = $user;
        $this->helper->mode = 'admin';
    }
    /**
     * -------------------------------------------------
     * | Display Product Category list                 |
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
     * | Get product category datatable data           |
     * |                                               |
     * | @param Request $request                       |
     * | @return View                                  |
     * |------------------------------------------------
     */
    public function getdata(Request $request)
    {
        try {
            $users = $this->helper->list();
            $userList = $users->where(function ($query) use ($request) {
                if ($request->status) {
                    $query->activeSearch($request->status);
                }
            })->get();
            return Datatables::of($userList)
                ->addColumn('action', function ($user) {
                    return $this->getPartials($this->viewConstant . '_add_action', ['user' => $user]);
                })
                ->editColumn('first_name', function ($user) {
                    return @$user->first_name ?? '---';
                })
                ->editColumn('middle_name', function ($user) {
                    return @$user->middle_name ?? '---';
                })
                ->editColumn('last_name', function ($user) {
                    return @$user->last_name ?? '---';
                })
                ->editColumn('status', function ($user) {
                    return $this->getPartials($this->viewConstant . '_add_status', ['user' => $user]);
                })
                ->editColumn('created_at', function ($user) {
                    return $user->proper_created_at;
                })
                ->addColumn('checkbox', function ($user) {
                    return $this->getPartials($this->viewConstant . '_add_checkbox', ['user' => $user]);
                })
                ->rawColumns(['created_at', 'checkbox', 'action', 'status','first_name','last_name','middle_name'])
                ->make(true);
        } catch (Exception $e) {
            abort('404');
        }
    }

        /**
     * -------------------------------------------------
     * | Get product category datatable data           |
     * |                                               |
     * | @param Request $request                       |
     * | @return View                                  |
     * |------------------------------------------------
     */
    public function getLoanData(Request $request)
    {
        try {
            $userList = UserLoanDetail::whereUserId($request->extraParam)
                        ->where(function ($query) use ($request) {
                            if ($request->status) {
                                $query->activeSearch($request->status);
                            }
                        })
                        ->get();
            return Datatables::of($userList)
                ->addColumn('action', function ($user) {
                    return $this->getPartials($this->viewConstant . '_add_action', ['user' => $user]);
                })
                ->editColumn('status', function ($user) {
                    return $this->getPartials($this->viewConstant . '_add_status', ['user' => $user]);
                })
                ->editColumn('created_at', function ($user) {
                    return $user->proper_created_at;
                })
                ->addColumn('checkbox', function ($user) {
                    return $this->getPartials($this->viewConstant . '_add_checkbox', ['user' => $user]);
                })
                ->rawColumns(['created_at', 'checkbox', 'action', 'status'])
                ->make(true);
        } catch (Exception $e) {
            abort('404');
        }
    }

    /**
     * -------------------------------------------------
     * | Create product category page                  |
     * |                                               |
     * | @param $id                                    |
     * | @return View                                  |
     * |------------------------------------------------
     */
    public function create($uuid = null)
    {
        try {
            if (isset($uuid)) {
                $user = $this->helper->detail($uuid);
            }
            $statusList = $this->properStatusList();
            $title = isset($uuid) ? __('formname.user.update') : __('formname.user.create');
            $loanStatusList = $this->loanStatusList();
            return view($this->viewConstant . 'create', ['loanStatusList'=>@$loanStatusList,'user' => @$user, 'title' => @$title,'statusList' => @$statusList]);
        } catch (Exception $e) {
            abort(404);
            return Redirect::back()->with('error', $e->getMessage());
        }
    }

    /**
     * -------------------------------------------------
     * | Store product category details                |
     * |                                               |
     * | @param SubjectFormRequest $request            |
     * | @return View                                  |
     * |------------------------------------------------
     */
    public function store(UserFormRequest $request, $uuid = null)
    {
        $this->helper->dbStart();
        try {
            $user = $this->helper->store($request, $uuid);
            $this->helper->dbEnd();
            $msg = __('admin/messages.action_msg', ['action' => !empty($request->id)?__('admin/messages.updated'):__('admin/messages.created'), 'type' => 'User']);
            return redirect()->route('user.index')->with('message', $msg);
        } catch (Exception $e) {
            $this->helper->dbRollBack();
            return Redirect::back()->with('error', $e->getMessage());
            abort('404');
        }
    }
    /**
     * -------------------------------------------------
     * | Delete product category details               |
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
                $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.deleted'), 'type' => 'User']);
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
     * | Delete multiple product category              |
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
                $msg = __('admin/messages.action_msg', ['action' => $action, 'type' => 'User']);
                return response()->json(['msg' => $msg, 'icon' => 'success']);
            }
            $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.deleted'), 'type' => 'User']);
            return response()->json(['msg' => @$msg, 'icon' => 'success']);
        } catch (Exception $e) {
            $this->helper->dbRollBack();
            return response()->json(['msg' => $e->getMessage(), 'icon' => 'info']);
        }
    }
    /**
     * -------------------------------------------------
     * | Update product category status details        |
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

    public function storeDoacument(Request $request,$uuid){
        $user = $this->helper->detail($uuid);
        $data = [];
        if ($request->hasFile('front_licence')){
            $data['front_licence'] = $this->storeImage($request->front_licence, $user);
        }
        if($request->hasFile('back_licence')){
            $data['back_licence'] = $this->storeImage($request->back_licence, $user);
        }
        if($request->hasFile('address_proof')){
            $data['address_proof'] = $this->storeImage($request->address_proof, $user);
        }
        if($request->hasFile('selfie')){
            $data['selfie'] = $this->storeImage($request->selfie, $user);
        }
        $data['user_id'] = $user->id;
        $data['identity'] = $request->identity;
        $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.updated'), 'type' => 'User Document']);
        UserDocument::updateOrcreate(['user_id'=>$user->id],$data);
        return redirect()->route('user.edit',['uuid'=>@$user->uuid])->with('message', $msg);
    }

    /**
     * ------------------------------------------------------
     * | Store image                                        |
     * |                                                    |
     * | @param $request,$user                              |
     * |-----------------------------------------------------
     */
    public function storeImage($request, $user)
    {
        $folderName = 'user-'.$user->id;
        $imageFunction = $this->uploadImage($request, $folderName,240,320);
        return @$imageFunction;
    }

    /**
     * ------------------------------------------------------
     * | Store image                                        |
     * |                                                    |
     * | @param $request,$user                              |
     * |-----------------------------------------------------
     */
    public function proceedStatus($uuid=null)
    {
        // $user = $this->helper->detail($uuid);
        $proceedData = ProceedData::where('loan_id',$uuid)->first();
        $proceedStatusList = $this->proceedStatusList();
        $statusList = $this->properStatusList2();
        return view($this->viewConstant .'proceed_status', ['title'=>'Proceed Status','proceedData' => @$proceedData,'proceedStatusList'=>@$proceedStatusList,'statusList'=>@$statusList]);
    }

    /**
     * ------------------------------------------------------
     * | Store image                                        |
     * |                                                    |
     * | @param $request,$user                              |
     * |-----------------------------------------------------
     */
    public function proceedStatusUpdate(Request $request)
    {
        ProceedData::updateOrCreate([
            'loan_id'=>$request->loan_id,
        ],[
            'user_id'=>$request->user_id,
            'selected_option'=>$request->selected_option,
            'status' => $request->status,
        ]);
        return redirect()->route('loan.index');
    }
}