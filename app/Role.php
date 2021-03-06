<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //Eloquent bindings
    public function userRoles() {
        return $this->hasMany('App\UserRole');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description',
    ];

}
