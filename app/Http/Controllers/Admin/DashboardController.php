<?php

namespace App\Http\Controllers\Admin;

use App\Models\Earning;
use App\Models\UserEarning;
use App\Models\UserLoanDetail;
use Illuminate\Http\Request;
class DashboardController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        $totalLoan = UserLoanDetail::count();
        $totalPendingLoan = UserLoanDetail::whereStatus(0)->count();
        $totalApprovedLoan = UserLoanDetail::whereStatus(1)->count();
        $earningUser = Earning::count();
        $totalPaidAmount = UserEarning::whereStatus(1)->sum('amount');
        $totalUnPaidAmount = UserEarning::whereStatus(0)->sum('amount');
        $totalEarningAmount = UserEarning::sum('amount');
        return view('admin.dashboard',['totalEarningAmount'=>@$totalEarningAmount,'totalPaidAmount'=>@$totalPaidAmount,'totalUnPaidAmount'=>@$totalUnPaidAmount,'earningUser'=>@$earningUser,'totalLoan'=>@$totalLoan,'totalPendingLoan'=>@$totalPendingLoan,'totalApprovedLoan'=>@$totalApprovedLoan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}