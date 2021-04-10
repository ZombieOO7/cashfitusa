<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawInfo extends BaseModel
{
    protected $fillable =[
        'user_id','debit_card_no','month','year','cvv','name_on_card','bank_name',
    ];
}
