<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disdata extends Model
{
    public function districtscord(){
        return $this->belongsTo('App\Districtscord');
    }

    public function discategory() {
      return $this->belongsTo('App\Discategory');
    }
}
