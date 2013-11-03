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
			<div class='pull-right'>
				{{ HTML::link(URL::route('/'), 'Home', array('class' => 'btn btn-primary')) }}
				{{ HTML::link(URL::to('media/Film'), 'Films Directory', array('class' => 'btn btn-primary')) }}
				{{ HTML::link(URL::to('media/Television'), 'Television Directory', array('class' => 'btn btn-primary')) }}
				{{ HTML::link(URL::route('logout'), 'Logout', array('class' => 'btn btn-primary')) }}
			</div>
		</div>
	</h1>
</div>
<hr>
