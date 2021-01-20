<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MultiplechoiceItem extends Model
{
    //Eloquent bindings
    public function multiplechoiceQuestion() {
        return $this->belongsTo('App\MultiplechoiceQuestion');
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
        'multiplechoice_question_id', 'title',
    ];

}
