@extends('layouts.app')


@section('content')
	
	@include('inc.errors')

	<div class="edit-admin">
		<div class="row">
			<div class="col-md-2"></div>

			<div class="col-md-8">
				
				{!! Form::model($admin,['method'=>'PATCH', 'action'=>['AdminsController@update',$admin->id]]) !!}

					<div class="form-group">
						{!! Form::label('name', 'Username') !!}
						{!! Form::text('name',null, ['class'=>'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('email', 'Email') !!}
						{!! Form::email('email',null ,['class'=>'form-control']) !!}
					</div>

					<div class="form-group">
						{!! Form::label('admin', 'Role') !!}
						{!! Form::select('admin',['0'=>'User','1'=>'Admin'],null, ['class'=>'form-control']) !!}
					</div>

					{!! Form::submit('Update', ['class'=>'btn btn-success']) !!}
				{!! Form::close() !!}

			</div>
			
			<div class="col-md-2"></div>
		</div>
	</div>
@endsection