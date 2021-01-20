<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //Eloquent bindings
    public function users() {
        return $this->hasMany('App\User');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    protected $table = 'role';
}
