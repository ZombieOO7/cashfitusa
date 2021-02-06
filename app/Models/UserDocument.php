<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    protected $fillable = [
        'uuid','user_id','front_licence','back_licence','address_proof','selfie','status','identy',
    ];
    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    /**
     * This function is used for getting table name
     *
     * @return void
     */
    public function getTableName()
    {
        return $this->getTable();
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
    public function getFrontLicenceUrlAttribute()
    {
        $file = config('constant.app_path').'user-'.$this->user_id.'/'.$this->front_licence;
        $avatarPath = url($file);
        return asset($avatarPath);
    }

    /**
     * This function is used for getting exists image
     */
    public function getBackLicenceUrlAttribute()
    {
        $file = config('constant.app_path').'user-'.$this->user_id.'/'.$this->back_licence;
        $avatarPath = url($file);
        return asset($avatarPath);
    }

    /**
     * This function is used for getting exists image
     */
    public function getSelfieUrlAttribute()
    {
        $file = config('constant.app_path').'user-'.$this->user_id.'/'.$this->selfie;
        $avatarPath = url($file);
        return asset($avatarPath);
    }

    /**
     * This function is used for getting exists image
     */
    public function getAddressProofUrlAttribute()
    {
        $file = config('constant.app_path').'user-'.$this->user_id.'/'.$this->address_proof;
        $avatarPath = url($file);
        return asset($avatarPath);
    }
}
