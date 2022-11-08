<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('img/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('favicon/site.webmanifest')}}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href={{asset("css/style.css")}}>

    <title>{{config('app.name')}}</title>
</head>

<body>
    <svg style="visibility: hidden; position: fixed;" width="0" height="0">
        <defs>
            <linearGradient id="cl1" gradientUnits="objectBoundingBox" x1="0" y1="0.5" x2="1" y2="0.5">
                <stop stop-color="#AA8A5D"/>
                <stop offset="20%" stop-color="#EFC484"/>
                <stop offset="80%" stop-color="#C9A36F"/>
                <stop offset="100%" stop-color="#AA8A5D"/>
            </linearGradient>
        </defs>
    </svg>

    @include('client.layout.header')

    {{-- Main --}}
    <main>
        @yield('content')
    </main>


    @include('client.layout.footer')
</body>

</html>