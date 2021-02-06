<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{

    protected $table = 'user_notifications';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','notification_id','created_at', 'updated_at','model_id','model_type','description','is_read'
    ];


}
