<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script>
        window.Laravel = {csrfToken: '{{ csrf_token() }}'};
    </script>
</head>
<body>
<div id="app">
    @yield('content')
</div>
<script src="{{ asset('js/init.js?v='.md5_file(public_path('js/init.js'))) }}"></script>
</body>
</html>