<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes;
    use HasRoles;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guard_name = 'web';
    protected $table = 'users';

    protected $fillable = [
        'uuid', 'email', 'password', 'email_verified_at', 'status', 'remember_token',
        'first_name','middle_name','last_name','phone','address','image',
    ];

    /**
     * This function is used for getting table name
     *
     * @return void
     */
    public function getTableName()
    {
        return $this->getTable();
    }

    protected $appends = ['status_text', 'full_name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Set Active/Inactive tag in List
     *
     * @return void
     */
    public function getActiveTagAttribute()
    {
        if ($this->status == '0') {
            return '<span class="m-badge  m-badge--danger m-badge--wide">' . __('formname.inactive') . '</span>';
        } else {
            return '<span class="m-badge  m-badge--success m-badge--wide">' . __('formname.active') . '</span>';
        }
    }

    /**
     * --------------------------------------------------------------
     * | Scope a query to active or inactive permission.            |
     * |                                                            |
     * | @param  $query, $status                                    |
     * | @return array                                              |
     * --------------------------------------------------------------
     */
    public function scopeActiveSearch($query, $status)
    {
        return $query->where('status', ($status == 'Active') ? 1 : 0);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Auto-sets values on creation.
     */

    /**
     * This attribute display user fullname.
     *
     * @param string attribute
     */

    public function getFullNameAttribute()
    {
        return ucwords($this->first_name . ' ' . $this->last_name);
    }

    /**
     * This attribute set ucfirst to user first_name.
     *
     * @param string attribute
     */

    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }
    /**
     * This attribute set ucfirst to user last_name.
     *
     * @param string attribute
     */

    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }
    /**
     * This attribute display user status.
     *
     * @param string attribute
     */
    public function getStatusTextAttribute()
    {
        $status = $this->status;
        return $status == 1 ? 'Active' : 'Inactive';
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
     * -------------------------------------------------------------
     * | Get path attribute                                        |
     * |                                                           |
     * | @return String                                            |
     * -------------------------------------------------------------
     */
    public function getPathTextAttribute()
    {
        return url($this->attributes['path']);
    }

    /**
     * This attribute set image src path.
     *
     * @param string path
     */
    public function getProfileImageAttribute()
    {
        $imagePath = !empty($this->profile_pic) && file_exists(public_path('uploads/users/') . $this->profile_pic) ?
        asset(('uploads/users/') . $this->profile_pic) : asset('images/default.png');
        return asset($imagePath);
    }

    /**
     * This attribute return verfied user list.
     *
     * @param array users
     */
    public function scopeVerifiedUser($query)
    {
        return $query->whereNotNull('email_verified_at');
    }

    /**
     * This function is used for getting active records of table
     *
     * @return void
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
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

    /**
     * This attribute display user fullname.
     *
     * @param string attribute
     */
    public function getFullNameTextAttribute($value)
    {
        return ucfirst($this->first_name . ' ' . $this->last_name);
    }

    /**
     * This attribute display user fullname with email id.
     *
     * @param string attribute
     */
    public function getFullNameWithEmailTextAttribute()
    {
        return ucfirst($this->first_name . ' ' . $this->last_name . ' (' . $this->email . ')');
    }

    public function bankDetail(){
        return $this->hasMany('App\Models\UserBankDetail','user_id');
    }

    public function loanDetail(){
        return $this->hasMany('App\Models\UserLoanDetail','user_id');
    }

    public function userLoanDetail(){
        return $this->hasOne('App\Models\UserLoanDetail','user_id')->orderBy('id','asc');
    }

    public function lastBankDetail(){
        return $this->hasOne('App\Models\UserBankDetail','user_id');
    }

    public function userDocument(){
        return $this->hasOne('App\Models\UserDocument','user_id');
    }

    public function userLoans(){
        return $this->hasMany('App\Models\LoanTransaction','user_id');
    }

    public function dueInstallments(){
        return $this->hasMany('App\Models\LoanTransaction','user_id')->where(['date'=>null,'amount'=>null]);
    }
    /**
     * This function is used for getting exists image
     */
    public function getImageNamesAttribute()
    {
        $file = config('constant.app_path').'users/'.$this->image;
        $avatarPath = !empty($this->image) && file_exists($file) ? url($file) : asset('images/user.png');
        return asset($avatarPath);
    }
}
