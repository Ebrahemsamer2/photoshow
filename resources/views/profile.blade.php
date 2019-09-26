@extends('layouts.app')

@section('content')
	
	<h2 class="text-center">{{ $user->name }}'s Profile</h2>
	<br>
	<div class="row">
		
		<div class="col-sm-4">
			@if($user->image)
			<img width="200" height="200" src="/images/{{ $user->image->filename }}" class="rounded-circle user-image">
			@else
			<img width="200" height="200" src="/images/user.jpg" class="rounded-circle user-image">
			@endif

		</div>

		<div class="col-sm-4">
			@include('inc.errors')
			@include('inc.sessions')

			{!! Form::model($user ,['method' => 'PATCH', 'action' => [ 'ProfileController@updateProfile', $user->name]]) !!}

				<div class="form-group">
					
					{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Username', 'required' => 'required']) !!}
				</div>
				<div class="form-group">
					{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email','required' => 'required']) !!}
				</div>
				<div class="form-group">

					{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
				</div>
				<div class="form-group">
					{!! Form::password('confirmpassword', ['class' => 'form-control', 'placeholder' => 'Confirm Password']) !!}

				</div>
				{!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
			{!! Form::close() !!}

		</div>
	</div>
	<hr>
	<div class="albums">
		<h2>{{ $user->name }}'s albums</h2>	
		<div class="row">
			
			@if(count($user->albums))
					@foreach($user->albums as $album)
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
			</div>
	</div>

	<div class="photos">

		<h4 class="title">{{ $user->name }}'s photos</h4>

		<div class="row">
			@if(count($user->photos))
			@foreach($user->photos as $photo)
				<div style="margin-bottom: 15px;" class="col-md-4">
					<img src="/images/{{ $photo->filename }}" alt="{{ $photo->name }}" class="img-fluid img-thumbnail">
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
		</div>
	</div>

@endsection