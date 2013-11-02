<html>
	<head>
		<meta charset='UTF-8' />
		<link rel='stylesheet' href='http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/css/bootstrap.min.css' type='text/css' />
		<title>Media Indexing System</title>
	</head>
	<body>
		@if($error = $errors->first())
			<div class='error'>
				{{ $error }}
			</div>
		@endif

		{{ Form::open(array('route' => 'loginHandler', 'method' => 'post')) }}
			{{ Form::label('username', 'Username') }}
			{{ Form::text('username', Input::old('username')) }}
			{{ Form::label('password', 'Password') }}
			{{ Form::password('password') }}
			{{ Form::submit('login') }}
		{{ Form::close() }}
	</body>
</html>