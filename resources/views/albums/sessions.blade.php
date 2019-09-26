@if(Session::has('deleted_album'))
	<div class="alert alert-danger">
	    {{ Session::get('deleted_album') }}
	</div>
@endif

@if(Session::has('album_created'))
	<div class="alert alert-success">
	    {{ Session::get('album_created') }}
	</div>
@endif

@if(Session::has('album_updated'))
	<div class="alert alert-success">
	    {{ Session::get('album_updated') }}
	</div>
@endif