<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Album;
use App\Photo;
use App\Video;

class HomeController extends Controller
{
    public function index()
    {
        $albums = Album::orderBy('id', 'desc')->take(3)->get();
        $photos = Photo::orderBy('id', 'desc')->take(3)->get();
        $videos = Video::orderBy('id', 'desc')->take(3)->get();
        return view('home', compact('albums', 'photos', 'videos'));
    }
}
