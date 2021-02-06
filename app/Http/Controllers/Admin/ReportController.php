<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Exports\JobExport;
use Illuminate\Http\Request;
use App\Helpers\ReportHelper;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\Admin\JobReportFormRequest;
use App\Models\Job;
use App\Models\JobStatus;

class ReportController extends BaseController
{
    private $helper;
    public $viewConstant = 'admin.reports.';
    public $job;
    public function __construct(ReportHelper $helper,Job $job)
    {
        $this->job = $job;
        $this->helper = $helper;
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
            $jobStatusList = $this->jobStatusList();
            return view($this->viewConstant . 'index', ['jobStatusList'=>@$jobStatusList,'statusList' => @$statusList]);
        } catch (Exception $e) {
            abort(404);
        }
    }

    /**
     * ------------------------------------------------------
     * | Export job data to excel                           |
     * |                                                    |
     * | @return File                                       |
     * |-----------------------------------------------------
     */
    public function export(JobReportFormRequest $request){
        try {
            $exportType = '.xls';
            $reportData = $this->helper->getData($request);
            $totalJob = $this->job::count();
            if(count($reportData) >0)
            {
                $months = monthList();
                return Excel::download(new JobExport($reportData,$totalJob), $request->year.(($request->month!=null)?'_'.@$months[$request->month]:'').'_job_report'.$exportType);
            }else{
                return redirect()->back()->with('error',__('admin/messages.not_found'))->withInput();
            }
        } catch (Exception $e) {
            abort(404);
        }
    }

    /**
     * ------------------------------------------------------
     * | Display total job data by job status               |
     * |                                                    |
     * | @return Resonse                                    |
     * |-----------------------------------------------------
     */
    public function generate(Request $request){
        try {
            $jobs = $this->helper->getJobData($request);
            $totalJob = count($jobs);
            if (count($jobs) >0) {
                return view('admin.exports.jobReport', ['jobs' => @$jobs, 'totalJob'=>@$totalJob]);
            }else{
                return response()->json(['msg' => __('admin/messages.not_found'), 'icon' => 'info']);
            }
        } catch (Exception $e) {
            return response()->json(['msg' => $e->getMessage(), 'icon' => 'info']);
        }
    }
}
