<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanNotification extends BaseModel
{
    protected $fillable = [
        'user_id', 'loan_detail_id', 'earning_id', 'user_earning_id', 'loan_document_id','app_id','content','type',
    ];
}
