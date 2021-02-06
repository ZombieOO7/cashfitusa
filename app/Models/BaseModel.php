<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class BaseModel extends Model
{
    use Notifiable;
    use SoftDeletes {
        SoftDeletes::restore as sfRestore;
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
                $query->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * This function is used for getting created date in d/m/y
     *
     * @return void
     */
    public function getCreatedAtTextAttribute()
    {
        $value = $this->attributes['created_at'];
        return date('d-m-Y', strtotime($value));
    }

    /**
     * This function is used for getting created date in d/m/y
     *
     * @return void
     */
    public function getCreatedAtTextTimeAttribute()
    {
        $value = $this->attributes['created_at'];
        return date('d-m-Y h:m:s', strtotime($value));
    }

    /**
     * Set Active/Inactive tag in List
     *
     * @return void
     */
    public function getActiveTagAttribute()
    {
        if($this->status == '0'){
            return '<span class="m-badge  m-badge--danger m-badge--wide">'.__('formname.inactive').'</span>';
        }
        else{
            return '<span class="m-badge  m-badge--success m-badge--wide">'.__('formname.active').'</span>';
        }
    }

    /**
     * Search Active/Inactive records in List
     *
     * @return void
     */
    public function scopeActiveSearch($query, $status)
    {
        return $query->where('status', ($status == 'Active') ? 1 : 0);
    }

    /**
     * This function is used for getting created date in d/m/y
     *
     * @return void
     */
    public function getProperCreatedAtAttribute()
    {
        $value = $this->attributes['created_at'];
        return '<span class="hid_spn">' . date('Ymd', strtotime($value)) . '</span>' . date('d-m-Y', strtotime($value));
    }

    /**
     * This function is used for getting active records of table
     *
     * @return void
     */
    public function scopeActive($query)
    {
        return $query->where('status',1);
    }
    /**
     * This function is used for getting not deleted records of table
     *
     * @return void
     */
    public function scopeNotDelete($query)
    {
        return $query->whereNull('deleted_at');

    }
}
