<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    protected $fillable = ['name', 'genre', 'profilepic'];

    public function artists(){
        return $this->belongsToMany('\App\Artist');
    }

    public function albums(){
        return $this->hasMany('\App\Album');
    }

    //helper functions
    public function checkartists($artist){
        $bool = false;
        foreach ($this->artists as $artisttocheck) {
            if ($artist->id == $artisttocheck->id){
                $bool = true;
            }
        }
        return $bool;
    }
}
