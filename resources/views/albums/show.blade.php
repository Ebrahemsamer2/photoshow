@extends('layouts.app')

@section('content')

	<div class="actions">
		<a class="btn btn-outline-warning" href="/albums">Go Back</a>
		@auth
			@if(auth()->user()->admin)
				<a class="btn btn-outline-info" href="/photos/create">New Photo</a>
			@endif
		@endauth
	</div>

	<div class="album-photos">
		<h4 class="title">{{ $album->name }}'s Photos</h4>

		<div class="row">
			@if(count($album->photos))
				@foreach($album->photos as $photo)
					<div class="col-md-4">
						<img src="{{ URL::to('/') }}/images/{{ $photo->filename }}" alt="{{ $photo->name }}" class="img-fluid img-thumbnail">
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
					</div>
				@endforeach
				@else
				<div class="col-md-3"></div>
				<div class="col-md-6">
					<div class="alert alert-info">
						Sorry, There's no photo in This Album
					</div>
				</div>
				<div class="col-md-3"></div>
				@endif
		</div>
		<br>
		<div class="row">
			<div class="col-sm-10">
				@auth
					@if(auth()->user()->admin)
						<a class="btn btn-outline-info" href="/photos/create">New Photo</a>
					@endif
				@endauth
			</div>
		</div>
	</div>

@endsection