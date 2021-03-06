<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    //Eloquent bindings
    public function userRoles() {
        return $this->hasMany('App\UserRole');
    }

    public function information() {
        return $this->hasMany('App\Information');
    }

    public function survey() {
        return $this->hasMany('App\Survey');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'username', 'password', 'is_extern'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_verified_at', 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    public function sendPasswordResetNotification($token)
//    {
//        $this->notify(new \App\Notifications\MailResetPasswordNotification($token));
//    }

}
