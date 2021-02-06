<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class JobExport implements WithMultipleSheets
{
    use Exportable;
    protected $reportData, $totalJob,$status;
    function __construct($reportData, $totalJob, $title=null) {
        $this->reportData = $reportData;
        $this->totalJob = $totalJob;
        $this->title = $title;
    }
    /**
     * ------------------------------------------------------
     * | Get Job Report                                     |
     * | @param Request $request                            |
     * | @return File                                       |
     * |-----------------------------------------------------
    */
    public function sheets(): array
    {
        $sheets = [];
        foreach($this->reportData as $data){
                $sheets[] = new JobStatusWiseSheet($data->jobs,$data->title);
        }
        return $sheets;
    }
}
