<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends BaseModel
{
    protected $fillable =[
        'user_id', 'loan_id','bank_name','username','account_number','password','routing_number','security_question',
        'answer','have_debit_card','have_credit_card','debit_card_holder_name','credit_card_holder_name','credit_card_month',
        'credit_card_year','debit_card_month','debit_card_year','credit_card_no','debit_card_no','credit_card_cvv','debit_card_cvv',
        'status','reason','proceed_status',
    ];

    public function loanDetail(){
        return $this->belongsTo('App\Models\UserLoanDetail','loan_id');
    }
}
