<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class LoanDocument extends BaseModel
{
    protected $fillable =[
        'name', 'uuid', 'type','status','loan_id','earning_id'
    ];

    public function loan(){
        return $this->belongsTo('App\Models\UserLoanDetail','loan_id');
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
        });
    }

    /**
     * This function is used for getting exists image
     */
    public function getImagePathAttribute()
    {
        // $path = ($this->address_proof !=null && file_exists(storage_path('app/earning/'.$this->address_proof))) ? 
        // url('storage/app/earning/'.$this->address_proof) : null;
        // return $path;

        $file = config('constant.app_path').'loan-'.$this->loan->user_id.'/'.$this->name;
        
        if(file_exists($file) && $this->name != null){
            $avatarPath = url($file);
            return $avatarPath;
        }
        return null;
    }

    public function getSizeAttribute()
    {
        $file = config('constant.app_path').'loan-'.$this->loan->user_id.'/'.$this->name;
        return \File::size($file);
    }

    /**
     * This function is used for getting exists image
     */
    public function getEarnImagePathAttribute()
    {
        $file = config('constant.app_path').'earning/'.$this->name;
        $avatarPath = url($file);
        return asset($avatarPath);
    }

    public function getEarnSizeAttribute()
    {
        $file = config('constant.app_path').'earning/'.$this->name;
        return \File::size($file);
    }
}
