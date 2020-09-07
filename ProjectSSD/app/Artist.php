<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = ['firstname', 'lastname', 'password', 'age', 'profilepic'];

    public function bands(){
        return $this->belongsToMany('\App\Band');
    }

    //helper functions
    public function checkbands($band){
        $bool = false;
        foreach ($this->bands as $bandtocheck) {
            if ($band->id == $bandtocheck->id){
                $bool = true;
            }
        }
        return $bool;
    }
}
