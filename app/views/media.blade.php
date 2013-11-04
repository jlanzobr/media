@extends('layout')

{{ HTML::script('js/common.js') }}
{{ HTML::script('js/css.js') }}
{{ HTML::script('js/standardista-table-sorting.js') }}

@include('header')

@section('content')

<div class='container'>
	@foreach($results as $media)
		@if( ! empty($media) and ! empty($media[0]))
			<table class='table table-bordered table-hover sortable' id='sortable'>
				<thead>
					<tr class='success'>
						<th>
							Name
						</th>
						<th>
							Year
						</th>
						@if(get_class($media[0]) !== 'Television')
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
							@if(get_class($item) !== 'Television')
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
								<a class='btn btn-info' title='Edit' href="{{ URL::to('edit/'.get_class($item).'/'.$item->id) }}">Edit</a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@else
			No results.
		@endif
	@endforeach
</div>

@stop
