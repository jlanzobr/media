@extends('layout')
@include('header')

@section('content')

<div class='container'>
	{{ Form::open(array('route' => 'update', 'method' => 'post', 'role' => 'form')) }}
		<table class='table table-bordered table-hover sortable' id='sortable'>
			<thead>
				<tr class='success'>
					<th>
						Name
					</th>
					<th>
						Year
					</th>
					@if( ! empty($item->extension))
					<th>
						Extension
					</th>
					@endif
					<th>
						Rating
					</th>
					<th>
						Description
					</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>
						{{ $item->name }}
					</td>
					<td>
						{{ $item->year }}
					</td>
					@if( ! empty($item->extension))
					<td>
						{{ $item->extension }}
					</td>
					@endif
					<td>
						{{ $item->rating }}
					</td>
					<td>
						{{ $item->description }}
					</td>
				</tr>
			</tbody>
		</table>
		<fieldset>
			<div class="form-group">
			{{ Form::label('imdb_id', 'IMDB ID:') }}
			{{ Form::text('imdb_id', Input::old('imdb_id'), array('class' => 'input', 'placeholder' => $item->imdb_id)) }}
			{{ Form::hidden('id', $item->id) }}
			{{ Form::hidden('model', get_class($item)) }}
			</div>
			{{ Form::submit('Update',  array('class' => 'btn btn-success')) }}
		</fieldset>
	{{ Form::close() }}
</div>

@stop
 
