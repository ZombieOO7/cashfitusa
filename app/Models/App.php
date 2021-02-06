<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;

class App extends BaseModel
{
    use Sluggable;
    protected $fillable =[
        'title', 'uuid', 'slug','status','image','video','description',
    ];
    /**
     * -------------------------------------------------------------
     * | Return the sluggable configuration array for this model.  |
     * |                                                           |
     * | @return array                                             |
     * -------------------------------------------------------------
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,
            ],
        ];
    }

    /**
     * This function is used for getting image path
     *
     * @return void
     */
    public function getImagePathAttribute()
    {
        $path = ($this->image !=null && file_exists(storage_path('app/apps/'.$this->image))) ? 
        url('storage/app/apps/'.$this->image) : asset('images/default.png');
        return $path;
    }

    /**
     * This function is used for getting image path
     *
     * @return void
     */
    public function getVideoPathAttribute()
    {
        $path = ($this->video !=null && file_exists(storage_path('app/apps/'.$this->video))) ? 
        url('storage/app/apps/'.$this->video) : null;
        return $path;
    }

    public function getTitleTextAttribute()
    {
        return strtolower($this->title);
    }

    public function userEarning(){
        return $this->hasMany('App\Models\UserEarning','app_id');
    }
}
