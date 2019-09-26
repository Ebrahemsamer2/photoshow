@if(Session::has('video_deleted'))
	<div class="alert alert-danger">
	    {{ Session::get('video_deleted') }}
	</div>
@endif

@if(Session::has('video_updated'))
	<div class="alert alert-success">
	    {{ Session::get('video_updated') }}
	</div>
@endif

@if(Session::has('video_created'))
	<div class="alert alert-success">
	    {{ Session::get('video_created') }}
	</div>
@endif