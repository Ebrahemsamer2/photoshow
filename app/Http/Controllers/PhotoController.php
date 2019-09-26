<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


use App\Album;
use App\Photo;

class PhotoController extends Controller
{

    public function __construct() {
        $this->middleware('admin',[ 'except' => array('index', 'show')]);
    }

    public function index() {
        $photos = Photo::orderBy('id', 'desc')->paginate(20);
        return view('photos.index', compact('photos'));
    }

    public function create()
    {
        $albums_titles = Album::pluck('name', 'id')->all();
        return view('photos.create', compact('albums_titles'));
    }

    public function store(Request $request)
    {
        
        $user_id = Auth()->user()->id;

        $inputs = $request->validate([
            'name'=>'required|min:3|max:20',
            'album_id'=>'required',
            'filename'=>'required'
        ]);

        $inputs['user_id'] = $user_id;
        
        // get file object
        $file = $request->file('filename');

        // get file name
        $fileName = $file->getClientOriginalName();

        // get file extension
        $fileExtension = $file->getClientOriginalExtension();

        // get file size
        $fileSize = $file->getClientSize();

        $fileWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);

        $fileToStore = $fileWithoutExtension . '_' . time() . '.'.$fileExtension;

        // move the file to a location in website
        $file->move('images', $fileToStore);

        $inputs['filename'] = $fileToStore;

        Photo::create($inputs);
        Session::flash('photo_created', 'you just added a photo to the gallary');
        return redirect('/photos');
    }

    public function edit($id)
    {
        $photo = Photo::findOrFail($id);
        $albums_titles = Album::pluck('name', 'id')->all();
        return view('photos.edit', compact('photo', 'albums_titles'));
    }

    public function update(Request $request, $id)
    {
         $user_id = Auth()->user()->id;

        $inputs = $request->validate([
            'name'=>'required|min:3|max:20',
            'album_id'=>'required',
        ]);

        $inputs['user_id'] = $user_id;

        // get file object
        if($file = $request->file('path')) {

            // get file name
            $fileName = $file->getClientOriginalName();

            // get file extension
            $fileExtension = $file->getClientOriginalExtension();

            // get file size
            $fileSize = $file->getClientSize();

            $fileWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME);

            $fileToStore = $fileWithoutExtension . '_' . time() . '.'.$fileExtension;

            // move the file to a location in website
            $file->move('images', $fileToStore);

            $inputs['path'] = $fileToStore;

            $inputs['size'] = $fileSize;
        }
        $photo = Photo::findOrFail($id);
        $photo->update($inputs);
        Session::flash('photo_updated', 'Photo has updated');
        return redirect('/photos');

    }

    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);

        // Delete Photo from images folder
        File::delete('images/'.$photo->filename);

        $photo->delete();

        Session::flash('photo_deleted', 'Photo has deleted successfully');

        return redirect('/photos');
    }

    public function download($id) {
        $photo = Photo::findOrFail($id);

        $file = public_path() . 'images/'.$photo->path;

        $headers = array(
            'Content-Type'  => 'application/jpg'
        );

        return Response::download('images/'.$photo->path,'Anything', $headers);
    }

}
