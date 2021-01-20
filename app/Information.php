<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    //Eloquent bindings
    public function user() {
        return $this->belongsTo('App\User');
    }

    protected $fillable = [
        'title', 'body', 'user_id'
    ];

    //protected $table = 'information';
}
