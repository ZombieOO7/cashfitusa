<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebSetting extends Model
{
    protected $table = 'web_settings';
    public $timestamps = true;
    protected $fillable = [
        'logo','google_url','facebook_url', 'favicon','twitter_url','youtube_url','meta_keywords', 
        'meta_description', 'app_name','max_loan_amount','percentage', 'video',
    ];

    /**
     * This function is used for getting exists image
     */
    public function getImageNamesAttribute()
    {
        $file = config('constant.app_path').config('constant.web_folder').'/'.$this->logo;
        $avatarPath = !empty($this->logo) && file_exists($file) ? url($file) : asset('images/logo.png');
        return asset($avatarPath);
    }

    /**
     * This function is used for getting exists image
     */
    public function getVideoNamesAttribute()
    {
        $file = config('constant.app_path').config('constant.web_folder').'/'.$this->video;
        $avatarPath = !empty($this->video) && file_exists($file) ? url($file) : asset('images/video.mp4');
        return asset($avatarPath);
    }

    /**
     * This function is used for getting exists image
     */
    public function getMailImageNamesAttribute()
    {
        $file = config('constant.app_path').config('constant.view_web_folder_resize') . $this->logo;
        $avatarPath = !empty($this->logo) && file_exists($file) ? url($file) : asset('images/logo.png');
        return asset($avatarPath);
    }


    /**
     * This function is used for getting exists image
     */
    public function getImageFaviconNamesAttribute()
    {
        $file = config('constant.app_path').config('constant.web_folder').'/'.$this->logo;
        $avatarPath = !empty($this->favicon) && file_exists($file) ? url($file) : asset('images/favicon.ico');
        return asset($avatarPath);

    }

    /**
     * This function is used for getting exists image
     */
    public function getImageThumbNamesAttribute()
    {
        $file = config('constant.app_path').config('constant.web_folder').'/thumb/'.$this->logo;
        $avatarPath = !empty($this->logo) && file_exists($file) ? url($file) : asset('images/logo.png');
        return asset($avatarPath);

    }

}
