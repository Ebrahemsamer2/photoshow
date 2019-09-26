@extends('layouts.app')


@section('content')

@include('admins.sessions')
@include('inc.errors')
<table class="table admins">
  <thead>
    <tr>
      <th scope="col">#ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  	@if(count($admins))
	  	@foreach($admins as $admin)
		    <tr>
		      <th scope="row">{{ $admin->id }}</th>
		      <td>{{ $admin->name }}</td>
		      <td>{{ $admin->email }}</td>
		      <td>
		      	@if($admin->admin)
		      		Admin
		      	@else
		      		User
		      	@endif
		      </td>
				<td>
		    		<a href="admins/{{ $admin->id }}/edit" class="btn btn-outline-info btn-sm">Edit</a>
		    		{!! Form::open(['class'=>'delete-form', 'method'=>'DELETE','action'=>['AdminsController@destroy',$admin->id]]) !!}

		    			{!! Form::submit('Delete', ['class'=>'btn btn-outline-danger btn-sm']) !!}

		    		{!! Form::close() !!}

		    		{!! Form::open(['class'=>'delete-form', 'method'=>'PATCH','action'=>'AdminsController@approve']) !!}
		    			@if($admin->admin)
		    				{!! Form::hidden('user_id', $admin->id) !!}
		    				{!! Form::submit('Un-Approve', ['class'=>'btn btn-outline-warning btn-sm']) !!}
		    			@else
		    				{!! Form::hidden('user_id', $admin->id) !!}
		    				{!! Form::submit('Approve', ['class'=>'btn btn-outline-success btn-sm']) !!}
		    			@endif

		    		{!! Form::close() !!}

		    	</td>
		    </tr>
	    @endforeach
    @endif
  </tbody>
</table>

@endsection