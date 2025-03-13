<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    

        <title>{{ $title ?? 'Page Title' }}</title>
    </head>
    <body>
	<div class="container">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#">Car Company</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
		  <li class="nav-item active">
			<a class="nav-link" href="{{ url('/') }}">Home </a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="{{ route('brands') }}">Brand</a>
		  </li>
		  
		  <li class="nav-item">
			<a class="nav-link disabled" href="{{ route('contact') }}"> Contact Us </a>
		  </li>
		</ul>
	  </div>
	</nav>
		
	
        {{ $slot }}
		</div>
    </body>
</html>
