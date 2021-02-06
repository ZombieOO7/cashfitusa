<?php

namespace App\Models;

class FireBaseCredential extends BaseModel
{
    protected $table = 'firebase_credentials';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'username', 'password','uid'
    ];

    /**
     * This function is for user trade relationship
    */
    public function userDetail() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}