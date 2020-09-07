<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['name', 'year', 'genre', 'cover'];

    public function band(){
        return $this->belongsTo('\App\Band');
    }
}
