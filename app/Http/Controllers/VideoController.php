<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Video;

class VideoController extends Controller
{
    // prevent visitors view admin pages like create - edit

    public function __construct() {
        $this->middleware('admin', ['except' => array('index', 'show')]);
    }

    public function index()
    {
        $videos = Video::orderBy('id', 'desc')->paginate(10);
        return view('videos.index', compact('videos'));
    }

    public function create()
    {
        return view('videos.create');
    }

    public function store(Request $request)
    {
        $user_id = Auth()->user()->id;

        $inputs = $request->validate([
            'title' => 'required|min:5|max:100',
            'filename' => 'required',
        ]);
        $inputs['user_id'] = $user_id;

        $file = $request->file('filename');
        // get file name
        $filename = $file->getClientOriginalName();

        $fileToStore = explode('.', $filename)[0] . '_' . time() . '.'. explode('.', $filename)[1];

        $file->move('vid' ,$fileToStore);
        
        $inputs['filename'] = $fileToStore;
        
        Video::create($inputs);
        Session::flash('video_created', 'Video has created');
        return redirect('/videos');
    }

    public function edit(Video $video)
    {
        return view('videos.edit', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $inputs = $request->validate([
            'title' => 'required|min:4|max:20'
        ]);

        if($request->has('title')) {
            $video->title = $request->title;
        }

        if($file = $request->file('filename')) {
            
            // delete Old Video

            File::delete('vid/' , $video->filename);

            $filename = $file->getClientOriginalName();

            $fileToStore = explode('.',$filename)[0] . '_' . time() . '.' . explode('.',$filename)[1];

            $file->move('vid', $fileToStore);

            $inputs['filename'] = $fileToStore;

        }
        $video->update($inputs);
        Session::flash('video_updated', 'Video has updated');
        return redirect('/videos');
    }

    public function destroy(Video $video)
    {   
        File::delete('vid/' , $video->path);
        $video->delete();
        Session::flash('video_deleted', 'Video has deleted ');
        return redirect('/videos');
    }
}
