<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\User;
use App\Models\UserLoanDetail;

class LoanExport implements FromView
{
    
    public function view(): View
    {
        $userLoanDetail = UserLoanDetail::orderBy('created_at','desc')->get();
        return view('admin.exports.loan', [
            'userLoanDetail' => $userLoanDetail
        ]);
    }
}
