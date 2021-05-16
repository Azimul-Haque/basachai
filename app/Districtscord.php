<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Districtscord extends Model
{
    public function disdatas(){
        return $this->hasMany('App\Disdata');
    }
}
