<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
        <meta name="description" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config('app.name') }}</title>

        <meta property="og:title" content="">
        <meta property="og:type" content="">
        <meta property="og:url" content="">
        <meta property="og:image" content="">

        <link rel="manifest" href="mix-manifest.json">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <link rel="apple-touch-icon-precomposed" href="/icon.png" />
        <link rel="icon" sizes="192x192" href="/icon.png" />
        <link rel="apple-touch-icon" href="icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body>

        @include('svgs')

        @include('nav')

        @include('footer')

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
