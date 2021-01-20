<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpenQuestion extends Model
{
    //Eloquent bindings
    public function survey() {
        return $this->belongsTo('App\Survey');
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
        'survey_id', 'title', 'description', 'rows',
    ];

    protected $table = 'open_question';
}
