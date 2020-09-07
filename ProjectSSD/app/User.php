<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//https://stackoverflow.com/questions/54255455/fatalthrowableerror-in-user-php-line-7-class-app-authenticatable-not-found-l
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'role_id'];

    // The attributes that should be hidden for arrays. (think of JSON serialization)
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }
}
