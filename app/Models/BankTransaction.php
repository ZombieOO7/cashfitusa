<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankTransaction extends BaseModel
{
    protected $fillable =[
        'user_id','order_date','description','amount','uuid'
    ];
}
