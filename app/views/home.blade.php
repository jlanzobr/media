@extends('layout')
@include('header')

@section('content')

<div class='container'>
	{{ Form::open(array('route' => 'search', 'method' => 'post', 'role' => 'form')) }}
		<fieldset>
			<div class="form-group">
			{{ Form::text('query', Input::old('query'), array('class' => 'input', 'placeholder' => 'Search')) }}
			</div>
			{{ Form::submit('Search',  array('class' => 'btn btn-success')) }}
		</fieldset>
	{{ Form::close() }}
</div>

@stop
