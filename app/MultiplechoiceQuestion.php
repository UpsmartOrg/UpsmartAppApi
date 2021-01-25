<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MultiplechoiceQuestion extends Model
{
    //Eloquent bindings
    public function survey() {
        return $this->belongsTo('App\Survey');
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
        'survey_id', 'title', 'description', 'multiple_answers', 'question_order'
    ];

}
