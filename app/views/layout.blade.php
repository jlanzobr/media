<html>
	<head>
		<meta charset='UTF-8' />
		{{ HTML::style('css/bootstrap.min.css') }}
		@if( ! empty($title))
			<title>Media Indexing System: {{ $title }}</title>
		@else
			<title>Media Indexing System</title>
		@endif
	</head>
	<body>
		@yield('content')
	</body>
</html>
