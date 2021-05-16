<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discategory extends Model
{
    public function disdatas() {
      return $this->hasMany('App\Disdata');
    } 
}
