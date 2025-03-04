<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body>
		<nav>
			<ul>
				<li><a href="{{ url('/') }}">Home</a></li>
				<li><a href="{{ route('brands') }}">Brand</a></li>
				<li><a href="{{ route('contact') }}">Contact Us</a></li>
			</ul>
		</nav>
        {{ $slot }}
    </body>
</html>
