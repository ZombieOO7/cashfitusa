<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class WithdrawInfo extends BaseModel
{
    protected $fillable =[
        'user_id','amount','debit_card_no','month','year','cvv','name_on_card','bank_name',
    ];

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
        });
    }

    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }
}
