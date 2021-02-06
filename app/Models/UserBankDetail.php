<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBankDetail extends BaseModel
{
    protected $fillable =[
        'user_id', 'bank_name', 'account_type', 'account_number', 'bank_address', 'status'
    ];
}
