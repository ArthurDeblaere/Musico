<?php

namespace App\Http\Controllers;

use App\Band;
use App\Album;
use App\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BandController extends Controller
{
    public function detail(Request $request, $id)
    {
        $user = Auth::user(); // retrieves the authenticated user

        $band = Band::findOrFail($id);
        $dir = 'storage/access/img/bands/' . strtolower($band->name) . '/';
        $images = [];
        //https://stackoverflow.com/questions/4202175/php-script-to-loop-through-all-of-the-files-in-a-directory
        //https://stackoverflow.com/questions/30885741/laravel-glob-public-path
        foreach (glob(public_path() . $dir . "*.*") as $filename) {
            //array_push($images,$dir . $filename);
            $images[] = $dir . basename($filename);
        }
        //$bandname = str_replace(' ', '_', strtolower($band->name));
        //$background = public_path() . '/img/backgrounds/' . strtolower($band->name) . '.png';
        $background ='storage/access/img/backgrounds/' . strtolower($band->name) . '.png';
        //var_dump($background);
        //return view('artist.detail', ['band' => $band, 'artists' => $band->artists]);
        return view('band.detail', [
            'band' => $band,
            'artists' => $band->artists,
            'images' => $images,
            'bradcamname' => $band->name,
            'backgroundimage' => $background,
            'editable' => true,
            'bandDescription' => 'storage/access/descriptions/bands/' . strtolower($band->name) . '.txt',
            'user'=>$user
        ]);
    }

    public function edit(Request $request, $id){
        $user = Auth::user();
        if (in_array($user->role_id, [3])){
            return redirect('/');
        }
        $band = Band::findOrFail($id);
        $artists = Artist::orderBy('lastname', 'ASC')->get();
        return view('band.add', [
            'backgroundimage' => 'storage/access/img/backgrounds/default.png',
            'bradcamname' => 'Add a band',
            'editable' => false,
            'artists' => $artists,
            'band' => $band,
            'user' => $user
        ]);
    }

    public function update(Request $request, $id){
        $user = Auth::user();
        if (in_array($user->role_id, [3])){
            return redirect('/');
        }
        $band = Band::findOrFail($id);
        $request->validate([
            'name'=> 'required',
            'genre' => 'required',
            'description' => 'required'
            //notice no image check
            //'band_pic' => 'image',
            //'band_background' => 'image'
        ]);

        $artist_band = $request->input('artist_checkboxes');

        //descriptions gets replaced
        Storage::delete('public/access/descriptions/bands/' . strtolower($request->input('name')) . '.txt');
        Storage::put('public/access/descriptions/bands/' . strtolower($request->input('name')) . '.txt', $request->input('description'));

        //image uploads
        //if none image is uploaded, the previous image stays but name is replaced
        if ($request->file('band_pic')){
            $file = $request->file('band_pic');
            Storage::delete('public/access/img/bands/' . strtolower($band->name) . '.png');
            //put new image in storage
            rename($file . $file->getExtension(), 'storage/access/img/bands/' . strtolower($request->input('name')) .'.png');
        }
        else{
            //rename files depending on name even if no new picture is added
            rename('storage/access/img/bands/' . strtolower($band->name) . '.png','storage/access/img/bands/' . strtolower($request->input('name')) . '.png');
        }

        if ($request->file('band_background')){
            $file = $request->file('band_background');
            Storage::delete('public/access/backgrounds/' . strtolower($request->input('name')) . '.png');
            //put new image in storage
            rename($file . $file->getExtension(), 'storage/access/img/backgrounds/' . strtolower($request->input('name')) . '.png');
        }
        else{
            //rename files depending on name even if no new picture is added
            rename('storage/access/img/backgrounds/'. strtolower($band->name). '.png', 'storage/access/img/backgrounds/' . strtolower($request->input('name')). '.png');
        }

        //rename('storage/img/bands/' . strtolower($band->name) . '/', 'storage/img/bands/' . strtolower($request->input('name')) . '/');

        //new relations
        $band->artists()->detach();
        for($i = 0; $i < sizeof($artist_band); $i++){
            $band->artists()->syncWithoutDetaching($artist_band[$i]);
        }

        //adjust parameters
        $band->name = $request->input('name');
        $band->genre = $request->input('genre');
        $band->profilepic = 'storage/access/img/bands/' . strtolower($request->input('name')) . '.png';

        $band->save();

        return redirect('/bands/' . $band->id);
    }

    public function add(Request $request){
        $user = Auth::user();
        if (in_array($user->role_id, [3])){
            return redirect('/');
        }
        $artists = Artist::orderBy('lastname', 'ASC')->get();
        return view('band.add', [
            'backgroundimage' => 'storage/access/img/backgrounds/default.png',
            'bradcamname' => 'Add a band',
            'editable' => false,
            'artists' => $artists,
            'band' => false,
            'user'=> $user
        ]);
    }

    public function store(Request $request){
        $user = Auth::user();
        if (in_array($user->role_id, [3])){
            return redirect('/');
        }
        //dd($request->input());
        $request->validate([
            'name'=> 'required|unique:App\Band',
            'genre' => 'required',
            'description' => 'required',
            'band_pic' => 'image',
            'band_background' => 'image'
        ]);
        $artist_band = $request->input('artist_checkboxes');
        //https://stackoverflow.com/questions/46686161/how-to-store-some-text-typed-in-textarea-as-a-text-file-in-laravel
        Storage::put('public/access/descriptions/bands/' . strtolower($request->input('name')) . '.txt', $request->input('description'));

        $file = $request->file('band_pic');
        $background = $request->file('band_background');
        //https://www.w3schools.com/php/func_filesystem_rename.asp
        rename($file . $file->getExtension(), 'storage/access/img/bands/' . strtolower($request->input('name')) . '.png');
        rename($background . $background->getExtension(), 'storage/access/img/backgrounds/' . strtolower($request->input('name')) . '.png');

        $band = Band::create($request->except('description', 'band_pic', 'band_background'));

        $band->profilepic = 'storage/access/img/bands/' . strtolower($band->name) . '.png';

        for($i = 0; $i < sizeof($artist_band); $i++){
            $band->artists()->syncWithoutDetaching($artist_band[$i]);
        }

        $band->save();

        return redirect('/bands/' . $band->id);
    }

    public function delete(Request $request, $id){
        $user = Auth::user();
        if (in_array($user->role_id, [2,3])){
            return redirect('/');
        }
        $band = Band::findOrFail($id);

        //detach from artists
        $band->artists()->detach();

        //delete band pictures
        Storage::delete('public/access/img/bands/' . strtolower($band->name) . '.png');
        Storage::delete('public/access/img/backgrounds/' . strtolower($band->name) . '.png');
        Storage::delete('public/access/descriptions/bands/' . strtolower($band->name) . '.txt');

        //delete albums (sadly)
        foreach ($band->albums() as $band_album){
            //detach relationships
            //https://stackoverflow.com/questions/49323458/can-detach-method-also-be-applied-to-one-to-many-relationship-in-laravel
            $band_album->band()->dissociate();
            $band_album->save();

            //delete album cover and description
            Storage::delete('public/access/img/covers/' . strtolower($band_album->name) . '.png');
            Storage::delete('public/access/descriptions/albums/' . strtolower($band_album->name) . '.txt');

            $band_album->delete();
        }
        $band->albums()->delete();
        $band->delete();

        return redirect('/');
    }
}
