<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEarning extends BaseModel
{
    protected $fillable=[
        'uuid','app_id','earning_user_id','account_no','date','amount',
    ];

    public function app(){
        return $this->belongsTo('App\Models\App','app_id');
    }

    public function earningUser(){
        return $this->belongsTo('App\Models\Earning','earning_user_id');
    }

    public function getProperDateAttribute(){
        $date =  ($this->date == null) ? null:date('m/d/Y',strtotime($this->date));
        return $date;
    }

    public function getProperDate2Attribute(){
        $date =  ($this->date == null) ? null:date('d M Y',strtotime($this->date));
        return $date;
    }

    public function setDateAttribute($date){
        $this->attributes['date'] = date('Y-m-d',strtotime($date));
    }
}
