<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;

class Earning extends BaseModel
{
    protected $fillable =[
        'user_id','first_name', 'middle_name', 'last_name','address1', 'address2', 'city', 'state', 'zip_code',
        'front_licence','address_proof','app_id','dob','ssn','back_licence','status'
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

    public function setDobAttribute($dob){
        $this->attributes['dob'] = date('Y-m-d',strtotime($dob));
    }

    public function getProperDobAttribute(){
        $dob =  ($this->dob == null) ? null:date('m/d/Y',strtotime($this->dob));
        return $dob;
    }

    public function app(){
        return $this->belongsTo('App\Models\App','app_id');
    }

    /**
     * This function is used for getting image path
     *
     * @return void
     */
    public function getFrontLicencePathAttribute()
    {
        $path = ($this->front_licence !=null && file_exists(storage_path('app/earning/'.$this->front_licence))) ? 
        url('storage/app/earning/'.$this->front_licence) : null;
        return $path;
    }

    /**
     * This function is used for getting image path
     *
     * @return void
     */
    public function getBackLicencePathAttribute()
    {
        $path = ($this->back_licence !=null && file_exists(storage_path('app/earning/'.$this->back_licence))) ? 
        url('storage/app/earning/'.$this->back_licence) : null;
        return $path;
    }

    /**
     * This function is used for getting image path
     *
     * @return void
     */
    public function getAddressProofPathAttribute()
    {
        $path = ($this->address_proof !=null && file_exists(storage_path('app/earning/'.$this->address_proof))) ? 
        url('storage/app/earning/'.$this->address_proof) : null;
        return $path;
    }

    public function getFullNameTextAttribute(){
        return @$this->first_name.' '.@$this->middle_name.' '.@$this->last_name;
    }

    public function getFullNameEmailTextAttribute(){
        return @$this->first_name.' '.@$this->middle_name.' '.@$this->last_name .'('.$this->user->email.')';
    }
}
