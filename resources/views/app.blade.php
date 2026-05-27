<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title inertia>{{ config('app.name', 'iTroveTTMS') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    {{-- Load compiled CSS (Tailwind, Bootstrap, AdminLTE) --}}
    @vite(['resources/css/app.css'])
    @routes

    {{-- Load compiled JS (Vue, Inertia, AdminLTE) --}}
    @vite(['resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    @inertia
</body>
</html>
