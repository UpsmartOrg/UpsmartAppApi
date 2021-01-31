<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    //Eloquent bindings
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function openQuestions() {
        return $this->hasMany('App\OpenQuestion');
    }

    public function multiplechoiceQuestions() {
        return $this->hasMany('App\MultiplechoiceQuestion');
    }

    public function answers() {
        return $this->hasMany('App\Answer');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'description', 'start_date', 'end_date',
    ];

    protected $hidden = [
        'updated_at',
    ];

}
