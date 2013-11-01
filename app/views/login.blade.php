@extends('layout')

@section('content')
	{{ Form::open(array('route' => 'user/loginHandler', 'method' => 'post')) }}
		{{ Form::label('username', 'Username') }}
		{{ Form::text('username', Input::old('username')) }}
		{{ Form::label('password', 'Password') }}
		{{ Form::password('password') }}
		{{ Form::submit('login') }}
	{{ Form::close() }}
@stop