<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @hasSection('title')
            @yield('title') |
        @endif {{ config('app.name', 'Sisconver') }}
    </title>
   <style>
        
   </style>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <!-- Styles -->
    @vite(['resources/css/style.css', 'resources/css/newStyle.css'])
    <!-- Scripts -->
   
    @livewireStyles

</head>

<body >
    <div id="app" class="">


        <main class="">
            @yield('content')
        </main>
    </div>
    @livewireScripts
   
<script src="{{ asset('jquery3.6.3.js') }}"></script>
@vite(['resources/js/app.js'])


</body>

</html>
