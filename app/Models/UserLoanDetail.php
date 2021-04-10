<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class UserLoanDetail extends BaseModel
{
    protected $fillable =[
        'user_id', 'loan_amount', 'repayment_amount', 'months', 'past_loan', 'pending_loan', 'pending_bill', 'status', 
        'first_name', 'middle_name', 'last_name', 'phone1', 'phone2', 'address1', 'address2', 'city', 'state', 'zip_code', 
        'time_of_residency','bank_name', 'account_type', 'account_number', 'bank_address', 'uuid','reason','routing_number',
        'dob','ssn','loan_type','auto_account_number',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    /*
     * Auto-sets values on creation
     */
    protected static function boot()
    {
        parent::boot();
        self::creating(function ($query) {
            if (Schema::hasColumn($query->getTableName(), 'uuid')) {
                $query->uuid = (string) \Str::uuid();
            }
            $query->auto_account_number = generateStudentNo();
        });
        // self::updating(function ($query) {
        //     $query->auto_account_number = generateStudentNo();
        // });
    }

    public function getFullNameTextAttribute(){
        return @$this->first_name.' '.@$this->middle_name.' '.@$this->last_name;
    }

    public function getProperCreatedAtTextAttribute(){
        return date('d-m-Y',strtotime($this->created_at));
    }

    public function getProperCreatedAtTimeAttribute(){
        return date('h:i:s',strtotime($this->created_at));
    }
    
    public function loanDocuments(){
        return $this->hasMany('App\Models\LoanDocument','loan_id')
                    ->whereNull('earning_id');
    }

    public function pendingDocuments(){
        return $this->hasMany('App\Models\LoanDocument','loan_id')
                    ->whereNull('earning_id')->where('status',0);
    }

    public function approvedDocuments(){
        return $this->hasMany('App\Models\LoanDocument','loan_id')
                    ->whereNull('earning_id')->where('status',1);
    }

    public function rejectedDocuments(){
        return $this->hasMany('App\Models\LoanDocument','loan_id')
                    ->whereNull('earning_id')->where('status',2);
    }
    public function getDobTextAttribute(){
        return date('m/d/Y',strtotime($this->dob));
    }

    public function transactions(){
        return $this->hasMany('App\Models\LoanTransaction','loan_id');
    }

    public function lastTransaction(){
        return $this->hasOne('App\Models\LoanTransaction','loan_id');
    }

    public function bankAccount(){
        return $this->hasOne('App\Models\BankAccount','loan_id');
    }
}
