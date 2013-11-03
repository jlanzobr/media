@extends('layout')

@section('content')

<div class='container'>
	<h1>
		<div class='Row'>
			<div class='pull-left'>
				@if( ! empty($title))
					<h1>Media Indexing System: {{ $title }}</h1>
				@else
					<h1>Media Indexing System</h1>
				@endif
			</div>
		</div>
	</h1>
	
	<br>
	{{ Form::open(array('route' => 'loginHandler', 'method' => 'post', 'role' => 'form')) }}
		<fieldset>
			<div class="form-group">
			{{ Form::text('username', Input::old('username'), array('class' => 'input-small', 'placeholder' => 'Username')) }}
			</div>
			<div class="form-group">
			{{ Form::password('password', array('class' => 'input-small', 'placeholder' => 'Password')) }}
			</div>
			{{ Form::submit('Login',  array('class' => 'btn btn-success')) }}
		</fieldset>
	{{ Form::close() }}
	<br>
	@if($error = $errors->first())
		<div class='error'>
			{{ $error }}
		</div>
	@endif
</div>

@stop
