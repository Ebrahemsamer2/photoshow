@extends('layouts.app')


@section('content')
	@include('inc.errors')
	<h4>Create Photo</h4>

	{!! Form::open(['methods'=>'POST', 'action'=>'PhotoController@store', 'files'=>true]) !!}

		<div class="form-group">
			{!! Form::select('album_id',$albums_titles,0,['class'=>'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::text('name',null, ['class'=>'form-control', 'placeholder'=>'Photo Title']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::file('filename', ['class'=>'form-control']) !!}
		</div>

		{!! Form::submit('Create Photo', ['class'=>'btn btn-outline-primary btn-sm']) !!}
	{!! Form::close() !!}

@endsection