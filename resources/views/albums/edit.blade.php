@extends('layouts.app')

@section('content')
	@include('inc.errors')
	<h3>Edit Album</h3>

	{!! Form::model($album,['method'=>'PATCH', 'action'=>['AlbumsController@update',$album->id],'files'=>true ]) !!}

		<div class="form-group">
			{!! Form::text('name', null,['class'=>'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::textarea('description', null, ['class' =>'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::file('cover_image_id',['class'=>'form-control']) !!}
		</div>

		{!! Form::submit('Update Album', ['class'=>'btn btn-info']) !!}
	{!! Form::close() !!}

@endsection