<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bin extends Model
{
    //Eloquent bindings
    public function zone() {
        return $this->hasOne('App\BinInfo');
    }

    protected $table = 'dbo.DataSensoren';

    public $timestamps = false;

    protected $connection = 'mysql_bins';
}
