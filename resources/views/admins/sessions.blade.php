@if(Session::has('admin_approve'))
	<div class="alert alert-info">
	    {{ Session::get('admin_approve') }}
	</div>
@endif

@if(Session::has('admin_updated'))
	<div class="alert alert-success">
	    {{ Session::get('admin_updated') }}
	</div>
@endif

@if(Session::has('admin_deleted'))
	<div class="alert alert-danger">
	    {{ Session::get('admin_deleted') }}
	</div>
@endif