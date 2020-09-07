<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SigninController extends Controller
{
    public function begin(){
        return view('signin', [
            'backgroundimage' => '/img/backgrounds/default.png',
            'bradcamname' => 'Sign In',
            'editable'=>false
        ]);
    }
}
