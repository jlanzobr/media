<div class='container'>
	<h1>
		<div class='Row'>
			<div class='pull-left'>
				<h1>Media Indexing System</h1>
			</div>
			<div class='pull-right'>
				{{ HTML::link(URL::route('/'), 'Home', array('class' => 'btn btn-primary')) }}
				{{ HTML::link(URL::to('films'), 'Films Directory', array('class' => 'btn btn-primary')) }}
				{{ HTML::link(URL::to('television'), 'Television Directory', array('class' => 'btn btn-primary')) }}
				{{ HTML::link(URL::route('logout'), 'Logout', array('class' => 'btn btn-primary')) }}
			</div>
		</div>
	</h1>
</div>
<hr>
