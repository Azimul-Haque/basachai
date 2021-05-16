<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public function blogs(){
        return $this->hasMany('App\Blog');
    }

    public function publications(){
        return $this->belongsToMany('App\Publication');
    }

    public function publication(){
        return $this->hasMany('App\Publication', 'id', 'submitted_by'); // submitted_by user
    }

    protected $fillable = [
        'name', 'email', 'password',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];
}
