@extends('layouts.app')

@section('content')

	<h4>Videos</h4>
	@include('videos.sessions')
	<div class="videos">
		<div class="row">
			@if(count($videos))
				@foreach($videos as $video)
					<div style="margin-bottom: 15px;" class="col-md-4">
						<video>
							<source src="/vid/{{ $video->filename }}" type="video/mp4">
							<source src="/vid/{{ $video->filename }}" type="video/ogg">
								Your Browser Does not Support this feature
						</video>
						<h4 class="text-center">{{ $video->title }}</h4>
						@auth
							@if(auth()->user()->admin)
								<a class="btn btn-outline-info btn-sm" href="/videos/{{ $video->id }}/edit">Edit</a>
								{!! Form::open(['method'=>'DELETE','action'=>['VideoController@destroy',$video],'class'=>'delete-form']) !!}
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
						<span class="lead">There is no videos to show
						@auth
							@if(auth()->user()->admin)
								<a class="btn btn-outline-primary" href="/videos/create">New Video</a>
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
						<a class="btn btn-outline-primary" href="/videos/create">New Video</a>
					@endif
				@endauth
			</div>
			<div class="col-sm">{{ $videos->links() }}</div>
		</div>

	</div>

@endsection