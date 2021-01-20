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

    public function dropdownItems() {
        return $this->hasMany('App\DropdownItem');
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
        'conducted_survey_id', 'open_question_id', 'open_question_answer', 'dropdown_item_id', 'multiplechoice_item_id',
    ];

    protected $table = 'answer';
}
