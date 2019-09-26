@extends('layouts.app')

@section('content')
    <h4 class="title">Recent Albums</h4>

    <div class="home-albums">
        <div class="row">
            @if(count($albums))
                @foreach($albums as $album)
                    <div style="margin-bottom: 15px;" class="col-md-4">
                        <a href="/albums/{{ $album->id }}"><img src="{{ URL::to('/') }}/images/{{ $album->image->filename }}" alt="{{ $album->name }}" class="img-fluid img-thumbnail"></a>
                        <h4 class="text-center">{{ $album->name }}</h4>
                        @auth
                            @if(auth()->user()->admin)
                                <a class="btn btn-outline-info btn-sm" href="/albums/{{ $album->id }}/edit">Edit</a>
                                {!! Form::open(['method'=>'DELETE','action'=>['AlbumsController@destroy',$album->id],'class'=>'delete-form']) !!}
                                    {!! Form::submit('Delete', ['class'=>"btn btn-outline-danger btn-sm"]) !!}
                                {!! Form::close() !!}
                            @endif
                        @endauth
                    </div>  
                @endforeach
            @else
               <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="alert alert-info text-center">
                        <span class="lead">There is no Albums to show
                        @auth
                            @if(auth()->user()->admin)
                                <a class="btn btn-outline-primary btn-sm" href="/albums/create">New Album</a>
                            @endif
                        @endauth
                        </span>
                    </div>
                </div>
                <div class="col-md-4"></div>     
            @endif
        </div>
        <div class="row">
            <div class="col-sm-10">
                @auth
                    @if(auth()->user()->admin)
                        <a class="btn btn-outline-primary" href="/albums/create">New Album</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
    <hr>
    <h4>Recent Photos</h4>

    <div class="photos">
        <div class="row">
            @if(count($photos))
            @foreach($photos as $photo)
                <div style="margin-bottom: 15px;" class="col-md-4">
                    <img src="{{ URL::to('/') }}/images/{{$photo->filename}}" alt="{{ $photo->name }}" class="img-fluid img-thumbnail">
                    <h4 class="text-center">{{ $photo->name }}</h4>
                    @auth
                        @if(auth()->user()->admin)
                            <a class="btn btn-outline-info btn-sm" href="/photos/{{ $photo->id }}/edit">Edit</a>
                            {!! Form::open(['class'=>'delete-form','method'=>'DELETE', 'action'=>['PhotoController@destroy',$photo->id]]) !!}
                                {!! Form::submit('Delete', ['class'=>'btn btn-outline-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                    @endauth
                    <a class="btn btn-outline-primary btn-sm" href="photos/{{ $photo->id }}/download"><i class="fa fa-download"></i> Downlaod</a>
                    <br>
                    <span class="badge badge-secondary">{{ $photo->album->name }}</span>
                </div>
            @endforeach
            @else
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="alert alert-info text-center">
                        <span class="lead">There is no Photos to show
                        @auth
                            @if(auth()->user()->admin)
                                <a class="btn btn-outline-primary btn-sm" href="/photos/create">New Photo</a>
                            @endif
                        @endauth
                        </span>
                    </div>
                </div>
                <div class="col-md-4"></div>
            @endif
        </div>
        <div class="row">
            <div class="col-sm-10">
                @auth
                    @if(auth()->user()->admin)
                        <a class="btn btn-outline-primary" href="/photos/create">New Photo</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
    
    <hr>
    <h4>Recent Videos</h4>
    <div class="videos">
        <div class="row">
            @if(count($videos))
            @foreach($videos as $video)
                <div style="margin-bottom: 15px;" class="col-md-4">
                    <video>
                        <source src="/vid/{{ $video->filename }}" type="video/mp4">
                        <source src="/vid/{{ $video->filename }}" type="video/ogg">
                            Your browser does not support the video tag.
                    </video>
                    <h4 class="text-center">{{ $video->title }}</h4>
                    @auth
                        @if(auth()->user()->admin)
                            <a class="btn btn-outline-info btn-sm" href="/videos/{{ $video->id }}/edit">Edit</a>
                            {!! Form::open(['class'=>'delete-form','method'=>'DELETE', 'action'=>['VideoController@destroy',$video->id]]) !!}
                                {!! Form::submit('Delete', ['class'=>'btn btn-outline-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        @endif
                    @endauth
                    <br>
                </div>
            @endforeach
            @else
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div class="alert alert-info text-center">
                        <span class="lead">There is no Videos to show
                        @auth
                            @if(auth()->user()->admin)
                                <a class="btn btn-outline-primary btn-sm" href="/videos/create">New Photo</a>
                            @endif
                        @endauth
                        </span>
                    </div>
                </div>
                <div class="col-md-4"></div>
            @endif
        </div>
        <br>
        <div class="row">
            <div class="col-sm-10">
                @auth
                    @if(auth()->user()->admin)
                        <a class="btn btn-outline-primary" href="/videos/create">New Video</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
@endsection