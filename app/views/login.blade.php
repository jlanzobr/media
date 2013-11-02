@extends('layout')

@if($error = $errors->first())
	<div class='error'>
		{{ $error }}
	</div>
@endif

@section('content')
	{{ Form::open(array('route' => 'loginHandler', 'method' => 'post')) }}
		{{ Form::label('username', 'Username') }}
		{{ Form::text('username', Input::old('username')) }}
		{{ Form::label('password', 'Password') }}
		{{ Form::password('password') }}
		{{ Form::submit('login') }}
	{{ Form::close() }}
@stop