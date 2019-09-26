@extends('layouts.app')

@section('content')
	@include('inc.errors')
	<h3>Edit Video</h3>

	<div class="row">
		<div class="col-md-6">
			{!! Form::model($video,['method'=>'PATCH', 'action'=>['VideoController@update',$video ],'files'=>true ]) !!}

				<div class="form-group">
					{!! Form::text('title', null,['class'=>'form-control']) !!}
				</div>

				<div class="form-group">
					{!! Form::file('filename',['class'=>'form-control']) !!}
				</div>

				{!! Form::submit('Update Video', ['class'=>'btn btn-info']) !!}
				
			{!! Form::close() !!}
		</div>

		<div class="col-md">
			<video>
				<source src="/vid/{{ $video->filename }}" type="video/mp4">
				<source src="/vid/{{ $video->filename }}" type="video/ogg">
					There is an Error in Browser
			</video>
		</div>

	</div>

@endsection