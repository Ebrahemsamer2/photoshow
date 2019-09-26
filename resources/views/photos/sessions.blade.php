@if(Session::has('photo_deleted'))
	<div class="alert alert-danger">
	    {{ Session::get('photo_deleted') }}
	</div>
@endif

@if(Session::has('photo_updated'))
	<div class="alert alert-success">
	    {{ Session::get('photo_updated') }}
	</div>
@endif

@if(Session::has('photo_created'))
	<div class="alert alert-success">
	    {{ Session::get('photo_created') }}
	</div>
@endif