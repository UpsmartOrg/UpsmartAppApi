<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //Eloquent bindings
    public function conductedSurvey() {
        return $this->belongsTo('App\ConductedSurvey');
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
        'conducted_survey_id', 'open_question_id', 'open_question_answer', 'multiplechoice_item_id',
    ];

}
