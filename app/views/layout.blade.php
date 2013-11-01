<html>
	<head>
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/css/bootstrap.min.css" type="text/css" />
	</head>
	<body>
		<div class="container">
			<h1>
				<div class="pull-right">
					{{ HTML::link(URL::to('/'), 'Home', array('class' => 'btn btn-primary')) }}
					{{ HTML::link('films', 'Films Directory', array('class' => 'btn btn-primary')) }}
					{{ HTML::link('television', 'Television Directory', array('class' => 'btn btn-primary')) }}
				</div>
			</h1>
		</div>
		<hr>
		@yield('content')
	</body>
</html>