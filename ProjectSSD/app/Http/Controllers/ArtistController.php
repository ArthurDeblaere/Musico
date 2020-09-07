<?php

namespace App\Http\Controllers;

use App\Album;
use App\Artist;
use App\Band;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ArtistController extends Controller
{
    public function detail(Request $request, $id){
        $user = Auth::user(); // retrieves the authenticated user
        $artist = Artist::findOrFail($id);
        $dir = '/storage/access/img/artists/' . strtolower($artist->firstname) . strtolower($artist->lastname) . '/';
        //var_dump($dir);
        $images = [];
        //$iterator = new DirectoryIterator(dirname(__FILE__));
        //https://stackoverflow.com/questions/4202175/php-script-to-loop-through-all-of-the-files-in-a-directory
        //https://stackoverflow.com/questions/30885741/laravel-glob-public-path
        foreach (glob(public_path() . $dir . "*.*") as $filename) {
            //array_push($images,$dir . $filename);
            $images[] = $dir . basename($filename);
        }
        $signature = public_path() . '/img/signatures/' . strtolower($artist->firstname) . strtolower($artist->lastname) . '.png';
        $background = 'storage/access/img/backgrounds/' . strtolower($artist->firstname) . strtolower($artist->lastname) . '.png';
        //var_dump($images);
        //var_dump($signature);
        return view('artist.detail', [
            'artist' => $artist,
            'images' => $images,
            'signature' => $signature,
            'bands' => $artist->bands,
            'bradcamname' => $artist->firstname . ' ' . $artist->lastname,
            'backgroundimage' => $background,
            'editable' => true,
            'artistDescription' => 'storage/access/descriptions/artists/' .strtolower($artist->firstname) . strtolower($artist->lastname) . '.txt',
            'user' => $user
        ]);
    }

    public function edit(Request $request, $id){
        $user = Auth::user();
        if (in_array($user->role_id, [3])){
            return redirect('/');
        }

        $artist = Artist::findOrFail($id);
        $bands = Band::orderBy('name', 'ASC')->get();
        return view('artist.add', [
            'artist' => $artist,
            'backgroundimage' => 'storage/access/img/backgrounds/default.png',
            'bradcamname' => 'Edit an artist',
            'editable' => false,
            'bands' => $bands,
            'user' => $user
        ]);
    }

    public function update(Request $request, $id){
        $user = Auth::user();
        if (in_array($user->role_id, [3])){
            return redirect('/');
        }
        $artist = Artist::findOrFail($id);

        $request->validate([
            'firstname'=> 'required',
            'lastname' => 'required',
            'age' => 'required',
            'description' => 'required'
            //notice no image check
            //'artist_pic' => 'image',
            //'artist_background' => 'image'
        ]);

        $artist_band = $request->input('band_checkboxes');

        //descriptions gets replaced
        Storage::delete('public/access/descriptions/artists/' . strtolower($artist->firstname) . strtolower($artist->lastname) . '.txt');
        Storage::put('public/access/descriptions/artists/' . strtolower($request->input('firstname')) . strtolower($request->input('lastname')) . '.txt', $request->input('description'));

        //image uploads
        //if none image is uploaded, the previous image stays but name is replaced with new
        if ($request->file('artist_pic')){
            $file = $request->file('artist_pic');
            //delete old
            Storage::delete('public/access/img/artists/' . strtolower($artist->firstname). strtolower($artist->lastname) . '.png');
            //put new image in storage
            rename($file . $file->getExtension(), 'storage/access/img/artists/' . strtolower($request->input('firstname')). strtolower($request->input('lastname')) . '.png');
        }
        else{
            rename('storage/access/img/artists/'. strtolower($artist->firstname). strtolower($artist->lastname) . '.png', 'storage/access/img/artists/' . strtolower($request->input('firstname')). strtolower($request->input('lastname')) . '.png');
        }

        if ($request->file('artist_background')){
            $file = $request->file('artist_background');
            Storage::delete('public/access/backgrounds/' . strtolower($artist->firstname) . strtolower($artist->lastname) . '.png');
            //put new image in storage
            rename($file . $file->getExtension(), 'storage/access/img/backgrounds/' . strtolower($request->input('firstname')). strtolower($request->input('lastname')) . '.png');
        }
        else{
            //rename files depending on name
            rename('storage/access/img/backgrounds/'. strtolower($artist->firstname). strtolower($artist->lastname) . '.png', 'storage/access/img/backgrounds/' . strtolower($request->input('firstname')). strtolower($request->input('lastname')) . '.png');
        }

        //image gallery
        if(is_dir('storage/access/img/bands/' . strtolower($artist->firstname) . strtolower($artist->lastname) . '/')){
            rename('storage/access/img/bands/' . strtolower($artist->firstname) . strtolower($artist->lastname) . '/', 'storage/access/img/artists/' . strtolower($request->input('firstname')). strtolower($request->input('lastname')) . '/');
        }

        //new relations
        $artist->bands()->detach();
        for($i = 0; $i < sizeof($artist_band); $i++){
            $artist->bands()->syncWithoutDetaching($artist_band[$i]);
        }

        //adjust parameters
        $artist->firstname = $request->input('firstname');
        $artist->lastname = $request->input('lastname');
        $artist->age = $request->input('age');
        $artist->profilepic = 'storage/access/img/artists/' . strtolower($request->input('firstname')) . strtolower($request->input('lastname')) .'.png';


        $artist->save();

        return redirect('/artists/' . $artist->id);
    }

    public function add(Request $request){
        $user = Auth::user();
        if (in_array($user->role_id, [3])){
            return redirect('/');
        }
        $bands = Band::orderBy('name', 'ASC')->get();
        return view('artist.add', [
            'backgroundimage' => 'storage/access/img/backgrounds/default.png',
            'bradcamname' => 'Add an artist',
            'editable' => false,
            'bands' => $bands,
            'artist' => false,
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
            'firstname'=> 'required',
            'lastname' => 'required',
            'age' => 'required',
            'description' => 'required',
            'artist_pic' => 'image',
            'artist_background' => 'image'
        ]);
        //dd($request->input('band_checkboxes'));
        $artist_band = $request->input('band_checkboxes');
        //https://stackoverflow.com/questions/46686161/how-to-store-some-text-typed-in-textarea-as-a-text-file-in-laravel
        Storage::put('public/access/descriptions/artists/' . strtolower($request->input('firstname')) . strtolower($request->input('lastname')) . '.txt', $request->input('description'));

        $file = $request->file('artist_pic');
        $background = $request->file('artist_background');
        //https://www.w3schools.com/php/func_filesystem_rename.asp
        rename($file . $file->getExtension(), 'storage/access/img/artists/' . strtolower($request->input('firstname')) . strtolower($request->input('lastname')) . '.png');
        rename($background . $background->getExtension(), 'storage/access/img/backgrounds/' . strtolower($request->input('firstname')) . strtolower($request->input('lastname')) . '.png');

        $artist = Artist::create($request->except('description', 'artist_pic'));

        $artist->profilepic = 'storage/access/img/artists/' . strtolower($artist->firstname) . strtolower($artist->lastname) . '.png';

        for($i = 0; $i < sizeof($artist_band); $i++){
            $artist->bands()->syncWithoutDetaching($artist_band[$i]);
        }

        $artist->save();

        return redirect('/artists/' . $artist->id);

    }

    public function delete(Request $request, $id){
        $user = Auth::user();
        if (in_array($user->role_id, [2,3])) {
            return redirect('/');
        }

        $artist = Artist::findOrFail($id);

        //detach relationships
        $artist->bands()->detach();

        //delete all pictures and description
        Storage::delete('public/access/descriptions/artists/' . strtolower($artist->firstname) . strtolower($artist->lastname) . '.txt');
        Storage::delete('public/access/img/artists/' . strtolower($artist->firstname). strtolower($artist->lastname) . '.png');
        Storage::delete('public/access/backgrounds/' . strtolower($artist->firstname) . strtolower($artist->lastname) . '.png');

        //image gallery
        if(is_dir('storage/access/img/bands/' . strtolower($artist->firstname) . strtolower($artist->lastname) . '/')) {
            Storage::delete('public/access/img/bands/' . strtolower($artist->firstname) . strtolower($artist->lastname) . '/');
        }

        $artist->delete();

        return redirect('/');
    }
}
