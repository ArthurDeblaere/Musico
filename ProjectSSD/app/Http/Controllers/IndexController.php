<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artist;
use App\Band;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    public function overview(){
        $user = Auth::user(); // retrieves the authenticated user
        //$role = Auth::user()->role(); // oh yes! it's an Eloquent object!
        //$id = Auth::id(); // retrieves the currently authenticated user's ID

        //default band and artists
        //many to many
        $bandsArr = [[1, 4], [2, 7, 9], [8, 10], [6, 11], [5], [3], [11, 12], [11, 13], [1, 11]];
        for($i = 0; $i<sizeof($bandsArr); $i++){
            $artist= Artist::findOrFail($i+1);
            for ($j=0; $j<sizeof($bandsArr[$i]); $j++){
                $artist->bands()->syncWithoutDetaching($bandsArr[$i][$j]);
            }
        }

        $albums = Album::orderBy('name', 'ASC')->get();
        $artists = Artist::orderBy('lastname', 'ASC')->get();
        $bands = Band::orderBy('name', 'ASC')->get();

        //dd($role);
        return view('index', [
            'albums' => $albums,
            'artists' => $artists,
            'bands' => $bands,
            'backgroundimage' => 'storage/access/img/backgrounds/default.png',
            'bradcamname' => 'Home',
            'editable' => false,
            'user' => $user
        ]);
    }
}
