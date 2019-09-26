@extends('layouts.app')

@section('content')

	
	<h3>Upload Video</h3>
	@include('inc.errors')
	<div class="row">
		<div class="col-md-6">
			{!! Form::open(['method' => 'POST', 'action'=>'VideoController@store', 'files'=>true]) !!}
				<div class="form-group">
					{!! Form::text('title',null,['class' => 'form-control', 'placeholder' => 'Video Title']) !!}
				</div>
				<div class="form-group">
					{!! Form::file('filename',['class' => 'form-control']) !!}
				</div>

				{!! Form::submit('Create Video', ['class' => 'btn btn-primary']) !!}
			{!! Form::close() !!}
		</div>
	</div>

@endsection