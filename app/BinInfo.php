<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BinInfo extends Model
{
    //Eloquent bindings
    public function zone() {
        return $this->belongsTo('App\Zone');
    }

    public function bin() {
        return $this->belongsTo('App\Bin');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'bin_id', 'zone_id'
    ];

    protected $table = 'bin_info';
}
