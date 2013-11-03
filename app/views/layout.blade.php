<html>
	<head>
		<meta charset='UTF-8' />
		<link rel='stylesheet' href='http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/css/bootstrap.min.css' type='text/css' />
		@if( ! empty($title))
			<title>Media Indexing System: {{ $title }}</title>
		@else
			<title>Media Indexing System</title>
		@endif
	</head>
	<body>
		@include('header')
		@yield('content')
	</body>
</html>
