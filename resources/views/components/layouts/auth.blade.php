<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Auth System' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link rel="stylesheet" href="{{ asset('font/stylesheet.css') }}" >
</head>
<body class="bg-gray-100 min-h-screen" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
    {{ $slot }}
</body>
</html>