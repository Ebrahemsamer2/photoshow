@extends('layouts.app')

@section('content')

	
	<h4>Albums</h4>
	@include('albums.sessions')
	<div class="albums">
		<div class="row">
			@if(count($albums))
				@foreach($albums as $album)
					<div style="margin-bottom: 15px;" class="col-md-4">
						<a href="/albums/{{ $album->id }}">
							<img src="/images/{{ $album->image->filename }}" alt="{{ $album->name }}" class="img-fluid img-thumbnail"></a>
						<h4 class="text-center">{{ $album->name }}</h4>
						@auth
							@if(auth()->user()->admin)
								<a class="btn btn-outline-info btn-sm" href="/albums/{{ $album->id }}/edit">Edit</a>
								{!! Form::open(['method'=>'DELETE','action'=>['AlbumsController@destroy',$album],'class'=>'delete-form']) !!}
									{!! Form::submit('Delete', ['class'=>"btn btn-outline-danger btn-sm"]) !!}
								{!! Form::close() !!}
							@endif
						@endauth
					</div>	
				@endforeach
				@else
				<div class="col-md-3"></div>
				<div class="col-md-4">
					<div class="alert alert-info text-center">
						<span class="lead">There is no Albums to show
						@auth
							@if(auth()->user()->admin)
								<a class="btn btn-outline-primary" href="/albums/create">New Album</a>
							@endif
						@endauth
						</span>
					</div>
				</div>
				<div class="col-md-3"></div>
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
			<div class="col-sm">{{ $albums->links() }}</div>
		</div>
	</div>

@endsection