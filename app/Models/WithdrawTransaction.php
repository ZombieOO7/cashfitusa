<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawTransaction extends BaseModel
{
    protected $fillable =[
        'uuid','user_id','order_date','description','amount',
    ];
}
