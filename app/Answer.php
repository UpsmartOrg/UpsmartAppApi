<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //Eloquent bindings
    public function survey() {
        return $this->belongsTo('App\Survey');
    }

    public function openQuestions() {
        return $this->hasMany('App\OpenQuestion');
    }

    public function multiplechoiceItems() {
        return $this->hasMany('App\MultiplechoiceItem');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'survey_id', 'open_question_id', 'open_question_answer', 'multiplechoice_item_id',
    ];

}
