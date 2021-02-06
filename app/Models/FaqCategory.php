<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;

class FaqCategory extends BaseModel
{
    use Sluggable;
    protected $fillable =[
        'title', 'uuid', 'slug','status','image'
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
        $path = ($this->image !=null && file_exists(storage_path('app/faqs/'.$this->image))) ? 
        url('storage/app/faqs/'.$this->image) : asset('images/default.png');
        return $path;
    }
}
