@extends('layouts.app')

@section('content')


	<div class="photos">
		@include('photos.sessions')
		<h4 class="title">{{ count($photos) }} Photo</h4>

		<div class="row">
			@if(count($photos))
			@foreach($photos as $photo)
				<div style="margin-bottom: 15px;" class="col-md-4">
					<img src="images/{{ $photo->filename }}" alt="{{ $photo->name }}" class="img-fluid img-thumbnail">
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
				<div class="col-md-3"></div>
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
				<div class="col-md-3"></div>
			@endif
		</div>
		<br>
		<div class="row">
			<div class="col-sm-10">
				@auth
					@if(auth()->user()->admin)
						<a class="btn btn-outline-primary" href="/photos/create">New Photo</a>
					@endif
				@endauth
			</div>
			<div class="col-sm">{{ $photos->links() }}</div>
		</div>
	</div>

@endsection