<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\User;
use App\Models\UserLoanDetail;

class LoanExport implements FromView
{
    protected $userLoanDetail;
    function __construct($userLoanDetail) {
        $this->userLoanDetail = $userLoanDetail;
    }
    public function view(): View
    {
        return view('admin.exports.loan', [
            'userLoanDetail' => $this->userLoanDetail
        ]);
    }
}
