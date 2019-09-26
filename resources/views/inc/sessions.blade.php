@if(Session::has('updated'))
	<div class="alert alert-success">
	    {{ Session::get('updated') }}
	</div>
@endif

@if(Session::has('nothing_changed'))
	<div class="alert alert-info">
	    {{ Session::get('nothing_changed') }}
	</div>
@endif

@if(Session::has('fail_update'))
	<div class="alert alert-danger">
	    {{ Session::get('fail_update') }}
	</div>
@endif