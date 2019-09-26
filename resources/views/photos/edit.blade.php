@extends('layouts.app')


@section('content')
	@include('inc.errors')
	<h4>Edit Photo</h4>

	{!! Form::model($photo,['method'=>'PATCH', 'action'=>['PhotoController@update', $photo->id],'files'=>true]) !!}

		<div class="form-group">
			{!! Form::select('album_id',$albums_titles,null, ['class'=>'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::text('name',null, ['class'=>'form-control']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::file('path', ['class'=>'form-control']) !!}
		</div>

		{!! Form::submit('Update Photo', ['class'=>'btn btn-outline-primary btn-sm']) !!}
	{!! Form::close() !!}

@endsection