<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanTransaction extends BaseModel
{
    protected $fillable = [
        'user_id','loan_id','amount','month','date',
    ];

    public function loanDetail(){
        return $this->belongsTo('App\Models\UserLoanDetail','loan_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    /**
     * This function is used for getting created date in d/m/y
     *
     * @return void
     */
    public function getProperDateAttribute()
    {
        $value = $this->attributes['date'];
        if($value != null){
            return date('m/d/Y', strtotime($value));
        }
        return '';
    }

    public function getProperAmountAttribute(){
        if($this->amount != null){
            return config('constant.currency_symbol').$this->amount;
        }
        return null;
    }
}
