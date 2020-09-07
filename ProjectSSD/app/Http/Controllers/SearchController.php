<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artist;
use App\Band;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function overview(){
        $user = Auth::user();

        $albums = Album::orderBy('name', 'ASC')->get();
        $artists = Artist::orderBy('lastname', 'ASC')->get();
        $bands = Band::orderBy('name', 'ASC')->get();

        return view('search', [
            'albums' => $albums,
            'artists' => $artists,
            'bands' => $bands,
            'backgroundimage' => 'storage/access/img/backgrounds/default.png',
            'bradcamname' => 'Search',
            'editable' => false,
            'user' => $user,
            'input' => false,
            'checks' => false
        ]);
    }

    public function search(Request $request){
        $user = Auth::user();
        //note: no required, checkboxes only is possible
        $request->validate([
            'input'=> 'max:255'
        ]);
        //dd($request->input('checkboxes'));
        //commas are sorted out
        $input = trim(str_replace(',', '', trim($request->input('input'))));
        //dd($input);

        //explode array in multiple singular parameters
        $inputarray = explode(' ', $input);
        //dd($inputarray);
        //if checkboxes are checked
        if ($request->input('checkboxes')){
            if (in_array('1', ($request->input('checkboxes')))){
                //if there is no input, show all
                if ($input === ''){
                    $albums = Album::all();
                }else{
                    $albums = $this->searchAlbum($inputarray);
                }
            }else{
                $albums = false;
            }

            if (in_array('2', ($request->input('checkboxes')))){
                if ($input === ''){
                    $artists = Artist::all();
                }else{
                    $artists = $this->searchArtist($inputarray);
                }
            }else{
                $artists = false;
            }

            if (in_array('3', ($request->input('checkboxes')))){
                if ($input === ''){
                    $bands = Band::all();
                }else{
                    $bands = $this->searchBand($inputarray);
                }
            }else{
                $bands = false;
            }
        }
        else{
            if ($input === ''){
                $albums = Album::all();
                $artists = Artist::all();
                $bands = Band::all();
            }else{
                $albums = $this->searchAlbum($inputarray);
                $artists = $this->searchArtist($inputarray);
                $bands = $this->searchBand($inputarray);
            }
        }

        return view('search', [
            'albums' => $albums,
            'artists' => $artists,
            'bands' => $bands,
            'backgroundimage' => 'storage/access/img/backgrounds/default.png',
            'bradcamname' => 'Search',
            'editable' => false,
            'user' => $user,
            'input' => $input,
            'checks' => $request->input('checkboxes')
        ]);
    }

    private function searchArtist($stringarray){
        $tmp = Artist::where('firstname','like', '%' . $stringarray[0] . '%')
            ->orWhere('lastname', 'like', '%' . $stringarray[0] . '%')
            ->orWhere('age', 'like', '%' . $stringarray[0] . '%')->get();
        //dd($array);
        for ($i = 1; $i < sizeof($stringarray); $i++){
            if (sizeof($tmp)>0){
                $array = Artist::where('firstname','like', '%' . $stringarray[$i] . '%')
                    ->orWhere('lastname', 'like', '%' . $stringarray[$i] . '%')->get();
                //see if there are also results for this query in the tmp string
                //if so tmp becomes the intersect, so only the objects that are in both arrays are used
                //repeats for all parameters and returns the tmp array

                //loop stops if no results are in tmp because its an AND relation
                // so if the tmp is empty additional parameters don't need checking
                $tmp = $tmp->intersect($array);
            }
        }
        //dd($tmp);
        return $tmp;
    }

    private function searchBand($stringarray){
        $tmp = Band::where('name','like', '%' . $stringarray[0] . '%')
            ->orWhere('genre', 'like', '%' . $stringarray[0] . '%')->get();
        for ($i = 1; $i < sizeof($stringarray); $i++){
            if (sizeof($tmp)>0){
                $array = Band::where('name','like', '%' . $stringarray[$i] . '%')
                    ->orWhere('genre', 'like', '%' . $stringarray[$i] . '%')->get();
                $tmp = $tmp->intersect($array);
            }
        }
        return $tmp;
    }

    private function searchAlbum($stringarray){
        $tmp = Album::where('name','like', '%' . $stringarray[0] . '%')
            ->orWhere('year', 'like', '%' . $stringarray[0] . '%')
            ->orWhere('genre', 'like', '%' . $stringarray[0] . '%')->get();
        for ($i = 1; $i < sizeof($stringarray); $i++){
            if (sizeof($tmp)>0){
                $array = Album::where('name','like', '%' . $stringarray[$i] . '%')
                    ->orWhere('genre', 'like', '%' . $stringarray[$i] . '%')->get();
                $tmp = $tmp->intersect($array);
            }
        }
        return $tmp;
    }
}
