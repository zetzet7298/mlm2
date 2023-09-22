<?php

namespace App\Models;

use App\Core\AccountConstant;
use App\Core\Traits\SpatieLogsActivity;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable 
// implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    use SpatieLogsActivity;
    use HasRoles;
    protected $primaryKey = 'id';
    public $incrementing = false; 
    public $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'username',
        'type',
        'first_name',
        'last_name',
        'email',
        'password',
        'password2',
        'phone',
        'sponsor_id',
        'direct_user_id',
        'indirect_user_id',
        'avatar',
        'sponsor_id',
        'coin',
        'state',
    ];
    public function username()
    {
        return 'username';
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getAdmin() {
        return User::where(['email' => 'admin@admin.com'])->first();
    }

    public static function isAdmin() {
        return auth()->user()->email == 'admin@admin.com';
    }
    /**
     * Get a fullname combination of first_name and last_name
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    /**
     * Get a fullname combination of first_name and last_name
     *
     * @return string
     */
    public static function getAccountType($type, $total_left = 0, $total_right = 0)
    {
        if($type == AccountConstant::TYPE_USER_MEMBER && $total_left >=5 && $total_right >= 5){
            return AccountConstant::TYPE_USER_SAPHIRE;
        }
        elseif($type == AccountConstant::TYPE_USER_MEMBER && $total_left >=50 && $total_right >= 50){
            return AccountConstant::TYPE_USER_RUBY;
        } 
        else{
            return $type;
        } 
    }

    /**
     * Prepare proper error handling for url attribute
     *
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset($this->avatar);
        }

        return asset(theme()->getMediaUrlPath().'avatars/blank.png');
    }

    /**
     * User relation to info model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    // public function info()
    // {
    //     return $this->hasOne(UserInfo::class);
    // }
    public function direct_user()
    {
        return $this->belongsTo(User::class, 'direct_user_id', 'id');
    }
    public function indirect_user()
    {
        return $this->belongsTo(User::class, 'indirect_user_id', 'id');
    }
}
