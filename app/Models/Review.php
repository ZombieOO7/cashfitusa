<?php

namespace App\Models;

use Illuminate\Support\Facades\Schema;

class Review extends BaseModel
{
    protected $fillable =['name', 'uuid', 'rate', 'review','status','image'];
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
     * This function is used for getting image path
     *
     * @return void
     */
    public function getImagePathAttribute()
    {
        $path = ($this->image !=null && file_exists(storage_path('app/review/'.$this->image))) ? 
        url('storage/app/review/'.$this->image) : asset('images/default.png');
        return $path;
    }
}
