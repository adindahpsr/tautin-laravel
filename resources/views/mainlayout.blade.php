<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Default Title')</title>
    <!-- Include other necessary meta tags and stylesheets -->
    @include('layout.styles')
</head>
<body>
    @include('layout.header')

    <main>
        @yield('maincontent')
    </main>

    @include('layout.footer')
    <!-- Include JavaScript files -->
    @include('layout.scripts')
</body>
</html>