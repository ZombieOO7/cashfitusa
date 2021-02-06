<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ContactUsFormRequest;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Yajra\Datatables\Datatables;

class ContactUsController extends BaseController
{
    /**
     * -----------------------------------------------------
     * | Contact us list                                   |
     * |                                                   |
     * | @return View                                      |
     * -----------------------------------------------------
     */
    public function index()
    {
        return view('admin.contact-us.index');
    }

    /**
     * -----------------------------------------------------
     * | Contact us datatables data                        |
     * |                                                   |
     * | @param Request $request                           |
     * | @return Response                                  |
     * -----------------------------------------------------
     */
    public function getdata(Request $request)
    {
        $contact_us = ContactUs::orderBy('created_at', 'desc');
        return Datatables::of($contact_us)
            ->addColumn('action', function ($contact) {
                return View::make('admin.contact-us._add_action', ['contact' => $contact])->render();
            })
            ->editColumn('email', function ($contact) {
                return \View::make('admin.contact-us._add_email', ['contact' => $contact])->render();
            })
            ->editColumn('message', function ($contact) {
                return \View::make('admin.contact-us._add_message', ['contact' => $contact])->render();
            })
            ->addColumn('checkbox', function ($contact) {
                return View::make('admin.contact-us._add_checkbox', ['contact' => $contact])->render();
            })
            ->editColumn('created_at', function ($contact) {
                return $contact->proper_created_at;
            })
            ->rawColumns(['created_at','checkbox', 'action', 'status', 'message', 'email'])
            ->make(true);
    }

    /**
     * -----------------------------------------------------
     * | Store/Edit contact us form                        |
     * |                                                   |
     * | @param ContactUsFormRequest $request              |
     * | @return Redirect                                  |
     * -----------------------------------------------------
     */
    public function store(ContactUsFormRequest $request)
    {
        if ($request->has('id') && !empty($request->id)) {
            $msg = __('admin/messages.contact_us_upadate');
        } else {
            $msg = __('admin/messages.contact_us_create');
        }
        ContactUs::updateOrCreate(
            ['id' => @$request->id],
            $request->all()
        );
        return Redirect::route('contact_us_index')->with('message', $msg);
    }

    /**
     * -----------------------------------------------------
     * | Delete contact us record                          |
     * |                                                   |
     * | @param Request $request                           |
     * | @return Response                                  |
     * -----------------------------------------------------
     */
    public function destroyContactUs(Request $request)
    {
        if (isset($request->id)) {
            $contact = ContactUs::find($request->id);
            $contact->delete();
            $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.deleted'), 'type' => 'Customer Inquiry']);
            return response()->json(['msg' => @$msg, 'icon' => 'success']);
        } else {
            return response()->json(['msg' => __('admin/messages.not_found'), 'icon' => 'info']);
        }
    }

    /**
     * -----------------------------------------------------
     * | Multiple Delete contact us record                 |
     * |                                                   |
     * | @param Request $request                           |
     * | @return Response                                  |
     * -----------------------------------------------------
     */
    public function multideleteContactUs(Request $request)
    {
        $contact_us_id_array = $request->input('ids');
        $contact_us = ContactUs::whereIn('id', $contact_us_id_array)->delete();
        $msg = __('admin/messages.action_msg', ['action' => __('admin/messages.deleted'), 'type' => 'Customer Inquiry']);
        return response()->json(['msg' => @$msg, 'icon' => 'success']);
    }

    public function detail($uuid){
        $contact = ContactUs::whereUuid($uuid)->first();
        return view('admin.contact-us.detail',['contact'=>@$contact]);
    }
}
