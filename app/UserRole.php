<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    //Eloquent bindings
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function role() {
        return $this->belongsTo('App\Role');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'role_id',
    ];
}
