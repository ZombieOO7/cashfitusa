<?php
namespace App\Helpers;
use App\Models\Job;
use App\Models\JobStatus;
use Illuminate\Database\Eloquent\Builder;

class ReportHelper extends BaseHelper
{
    protected $jobStatus;
    public function __construct(JobStatus $jobStatus, Job $job)
    {
        $this->jobStatus = $jobStatus;
        $this->job = $job;
        parent::__construct();
    }
    /**
     * ------------------------------------------------------
     * | Get job list                                       |
     * |                                                    |
     * |-----------------------------------------------------
     */
    public function list()
    {
        return $this->jobStatus::orderBy('id', 'desc');
    }
    /**
     * ------------------------------------------------------
     * | Get report data list                               |
     * |                                                    |
     * |-----------------------------------------------------
     */
    public function getData($request){
        $reportData = $this->jobStatus::with(['jobs'=> function ($query) use($request) {
                        $query->whereYear('created_at',$request->year);
                        if($request->month != null)
                            $query->whereMonth('created_at',$request->month);
                        if($request->date != null)
                            $query->whereDay('created_at',$request->date);
                    }])
                    ->where(function ($q) use($request){
                        if($request->status != null)
                            $q->where('id',$request->status);
                    })
                    ->get();
        return $reportData;
    }

    public function getJobData($request){
        $reportData = $this->job::where(function ($query) use($request) {
                    $query->whereYear('created_at', $request->year);
                    if ($request->month != null) {
                        $query->whereMonth('created_at', $request->month);
                    }
                    if ($request->date != null) {
                        $query->whereDay('created_at', $request->date);
                    }
                    if($request->status != null){
                        $query->where('job_status_id',$request->status);
                    }
                })
                ->get();
        return $reportData;
    }

}