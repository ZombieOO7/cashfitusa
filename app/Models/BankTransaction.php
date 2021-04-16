<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Schema;

class BankTransaction extends BaseModel
{
    use SoftDeletes;
    protected $fillable =[
        'user_id','order_date','description','amount','uuid','date',
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

    public function getProperDateAttribute(){
        $value = $this->attributes['date'];
        return '<span class="hid_spn">' . date('Ymd', strtotime($value)) . '</span>' . date('d-m-Y', strtotime($value));
    }
    public function getProperDateTextAttribute(){
        $value = $this->attributes['date'];
        return date('d-m-Y', strtotime($value));
    }
}
