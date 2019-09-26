@extends('layouts.app')

@section('content')
	@include('inc.errors')
		@if(Session::get('album_created'))
			<div class="alert alert-success">
				{{ Session::get('album_created') }}
			</div>
		@endif
	<h3>Create Album</h3>

	{!! Form::open(['method'=>'POST', 'action'=>'AlbumsController@store','files'=>true]) !!}

		<div class="form-group">
			{!! Form::text('name', null,['class'=>'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::textarea('description', null, ['class' =>'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::file('cover_image_id',['class'=>'form-control']) !!}
		</div>

		{!! Form::submit('Create Album', ['class'=>'btn btn-success']) !!}
	{!! Form::close() !!}

@endsection