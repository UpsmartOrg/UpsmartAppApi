<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DropdownItem extends Model
{
    //Eloquent bindings
    public function dropdownQuestion() {
        return $this->belongsTo('App\DropdownQuestion');
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
        'dropdown_question_id', 'title',
    ];

    protected $table = 'dropdown_item';
}
