<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artist;
use App\Band;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function overview()
    {
        $user = Auth::user(); // retrieves the authenticated user
        $albums = Album::orderBy('updated_at', 'asc')->get();
        $artists = Artist::all();
        $bands = Band::all();

        return view('album.overview', [
            'albums' => $albums,
            'artists' => $artists,
            'bands' => $bands,
            'editable'=>false,
            'user' => $user
        ]);
    }

    public function detail(Request $request, $id){
        $user = Auth::user(); // retrieves the authenticated user
        $album= Album::findOrFail($id);
        $artists = Artist::all();
        $bands = Band::all();

        return view('album.detail', [
            'album' => $album,
            'artists' => $artists,
            'bands' => $bands,
            'backgroundimage' => 'storage/access/img/backgrounds/' . strtolower($album->band->name) . '.png',
            'bradcamname' => $album->name . ' by ' . $album->band->name,
            'editable'=> true,
            'albumDescription' => 'storage/access/descriptions/albums/' .strtolower($album->name) . '.txt',
            'user'=> $user
        ]);
    }

    public function edit(Request $request, $id){
        $user = Auth::user(); // retrieves the authenticated user

        if (in_array($user->role_id, [3])){
            return redirect('/');
        }
        $album = Album::findOrFail($id);

        return view('album.add', [
            'album' => $album,
            'backgroundimage' => 'storage/access/img/backgrounds/default.png',
            'bradcamname' => 'Edit an album',
            'editable' => false,
            'user' => $user
        ]);
    }

    public function update(Request $request, $id){
        $user = Auth::user();
        if (in_array($user->role_id, [3])){
            return redirect('/');
        }
        $album = Album::findOrFail($id);

        $request->validate([
            'name'=> 'required',
            'genre' => 'required',
            'year' => 'required',
            'band_name' => 'required',
            'description' => 'required'
            //notice no image check cause optional
            //'album_cover' => 'image'
        ]);

        //descriptions gets replaced
        Storage::delete('public/access/descriptions/albums/' . strtolower($album->name) . '.txt');
        Storage::put('public/access/descriptions/albums/' . strtolower($request->input('name')) . '.txt', $request->input('description'));

        //image uploads
        //if none image is uploaded, the previous image stays but name is changed to new name
        if ($request->file('album_cover')){
            $file = $request->file('album_cover');
            Storage::delete('public/access/img/covers/' . strtolower($album->name) . '.png');
            //put new image in storage
            rename($file . $file->getExtension(), 'storage/access/img/covers/' . strtolower($request->input('name')) . '.png');
        }
        else{
            //rename albumcover
            rename('storage/access/img/covers/' . strtolower($album->name) . '.png','storage/access/img/covers/' . strtolower($request->input('name')) . '.png');
        }
        //adjust parameters
        $album->name = $request->input('name');
        $album->genre = $request->input('genre');
        $album->year = $request->input('year');
        $album->cover = 'storage/access/img/covers/' . strtolower($request->input('name')) . '.png';

        $band_album = Band::where('name', $request->input('band_name'))->first();
        $album->band_id = $band_album->id;

        $album->save();

        return redirect('/albums/' . $album->id);
    }

    public function add(Request $request){

        $user = Auth::user();
        if (in_array($user->role_id, [3])){
            return redirect('/');
        }
        $bands = Band::orderBy('name', 'ASC')->get();
        //dd($bands);
        return view('album.add', [
            'backgroundimage' => 'storage/access/img/backgrounds/default.png',
            'bradcamname' => 'Add an album',
            'editable' => false,
            'bands'=>$bands,
            'album' => false,
            'user' => $user
        ]);
    }

    public function store(Request $request){
        $user = Auth::user();
        if (in_array($user->role_id, [3])){
            return redirect('/');
        }
        //dd($request->input());
        $request->validate([
            'name'=> 'required|unique:App\Album',
            'genre' => 'required',
            'year' => 'required',
            'band_name' => 'required',
            'description' => 'required',
            'album_cover' => 'image'
        ]);
        //https://stackoverflow.com/questions/46686161/how-to-store-some-text-typed-in-textarea-as-a-text-file-in-laravel
        Storage::put('public/access/descriptions/albums/' . strtolower($request->input('name')) . '.txt', $request->input('description'));

        $file = $request->file('album_cover');
        //https://www.w3schools.com/php/func_filesystem_rename.asp
        rename($file . $file->getExtension(), 'storage/access/img/covers/' . strtolower($request->input('name')) . '.png');

        $band_album = Band::where('name', $request->input('band_name'))->first();
        //dd($band_album);
        $album = Album::create($request->except('band_name', 'description', 'album_cover'));
        $album->band_id = $band_album->id;
        $album->cover = 'storage/access/img/covers/' . strtolower($album->name) . '.png';
        $album->save();

        return redirect('/albums/' . $album->id);

    }

    public function delete(Request $request, $id){
        $user = Auth::user(); // retrieves the authenticated user

        if (in_array($user->role_id, [2, 3])){
            return redirect('/');
        }
        $album = Album::findOrFail($id);
        //detach relationships
        //https://stackoverflow.com/questions/49323458/can-detach-method-also-be-applied-to-one-to-many-relationship-in-laravel
        $album->band()->dissociate();
        $album->save();

        //delete album cover and description
        Storage::delete('public/access/img/covers/' . strtolower($album->name) . '.png');
        Storage::delete('public/access/descriptions/albums/' . strtolower($album->name) . '.txt');

        $album->delete();

        return redirect('/');
    }

    //https://www.itsolutionstuff.com/post/laravel-57-autocomplete-search-from-database-using-typeahead-jsexample.html
    public function autocomplete(Request $request)
    {
        $data = Band::select("name")
            ->where("name","LIKE","%{$request->input('query')}%")
            ->get();

        return response()->json($data);
    }
}
