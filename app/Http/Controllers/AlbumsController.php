<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

use App\Album;
use App\Image;

class AlbumsController extends Controller
{

    public function __construct() {
        $this->middleware('admin', ['except' => array('index', 'show')]);
    }

    public function index()
    {
        $albums = Album::orderBy('id', 'desc')->paginate(10);
        return view('albums.index', compact('albums'));
    }

    public function create()
    {
        return view('albums.create');
    }

    public function store(Request $request)
    {
        $user_id = Auth()->user()->id;

        $inputs = $request->validate([
            'name'          => 'required',
            'description'   => 'required',
            'cover_image_id'    => 'required',
        ]);

        $inputs['user_id'] = $user_id;

        $file = $request->file('cover_image_id');

        // get Filename with extension
        $filePath = $file->getClientOriginalName();

        // get Filename without Extension
        $filename = pathinfo($filePath, PATHINFO_FILENAME);

        // get Extension
        $fileExtension = $file->getClientOriginalExtension();
        
        // stored file in database
        $fileToStore = $filename.'_'.time().'.'.$fileExtension;

        // uploading file to public/images folder
        $file->move('images', $fileToStore);

        $album_id = Album::create($inputs)->id;

        $image_id = Image::create(['filename' => $fileToStore, 'imageable_id' => $album_id,'imageable_type' => 'App\Album']);
        Session::flash('album_created','Album created successfully');
        
        return redirect('/albums');
    }

    public function show(Album $album)
    {   
        return view('albums.show', compact('album'));
    }

    public function edit(Album $album)
    {
        return view('albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $user_id = Auth()->user()->id;

        $inputs = $request->validate([
            'name'          => 'required',
            'description'   => 'required',
        ]);

        $inputs['user_id'] = $user_id;
        $album->update($inputs);

        if($file = $request->file('cover_image_id')) {
        // get Filename with extension
            $filePath = $file->getClientOriginalName();

            // get Filename without Extension
            $filename = pathinfo($filePath, PATHINFO_FILENAME);

            // get Extension
            $fileExtension = $file->getClientOriginalExtension();
            
            // stored file in database
            $fileToStore = $filename.'_'.time().'.'.$fileExtension;

            // uploading file to public/images folder
            $file->move('images', $fileToStore);

            $album->image->update(['filename' => $fileToStore, 'imageable_id' => $album->id, 'imageable_type' => 'App\Album']);

        }
        Session::flash('album_updated','Album has updated successfilly');
        return redirect('/albums');
    }

    public function destroy(Album $album)
    {
        // delete album image photo from images folder

        File::delete('images/'.$album->image->filename);

        $album->delete();

        Session::flash('deleted_album','Album has Deleted');

        return redirect('/albums');
    }
}
