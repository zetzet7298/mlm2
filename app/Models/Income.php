<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    // use HasFactory, Notifiable;
    // use SpatieLogsActivity;
    // use HasRoles;
    protected $table = 'income';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'coin',
        'content',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * User relation to info model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    // public function info()
    // {
    //     return $this->hasOne(UserInfo::class);
    // }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
