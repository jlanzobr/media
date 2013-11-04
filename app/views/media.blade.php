@extends('layout')

{{ HTML::script('js/common.js') }}
{{ HTML::script('js/css.js') }}
{{ HTML::script('js/standardista-table-sorting.js') }}

@include('header')

@section('content')

<div class='container'>
	@if( ! empty($media))
		<table class='table table-bordered table-hover sortable' id='sortable'>
			<thead>
				<tr class='success'>
					<th>
						Name
					</th>
					<th>
						Year
					</th>
					@if( ! empty($media[0]->extension))
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
					<th>
						Edit
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach($media as $item)
					<tr>
						<td>
							{{ $item->name }}
						</td>
						<td>
							{{ $item->year }}
						</td>
						@if( ! empty($media[0]->extension))
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
						<td>
							<a class='btn btn-info' title='Edit' href="{{ URL::to('films' . $item->id) }}">Edit</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		No results.
	@endif
</div>

@stop
