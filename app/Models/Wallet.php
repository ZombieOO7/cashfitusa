<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends BaseModel
{
    protected $fillable =[
        'user_id','wallet_balance','transfer_amount','withdrawal_amount','uuid'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
