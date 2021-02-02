<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    //Eloquent bindings
    public function binInfo() {
        return $this->hasMany('App\BinInfo');
    }

    protected $fillable = [
        'name', 'description',
    ];
}
