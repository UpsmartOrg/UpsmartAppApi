<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DropdownQuestion extends Model
{
    //Eloquent bindings
    public function survey() {
        return $this->belongsTo('App\Survey');
    }

    public function dropdownItems() {
        return $this->hasMany('App\DropdownItem');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'survey_id', 'title', 'description',
    ];

    protected $table = 'dropdown_question';
}
