<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!--charset-->
        <meta charset="utf-8">
        <meta http-equiv="cleartype" content="on">
        <!-- Responsive and mobile friendly stuff -->
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--title-->
        <title>PRIN6 @yield('title', 'PRIN6')</title>
        <!-- Fonts -->
        <!--<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!--csrf-->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--icon-->
        <link rel="icon" type="image/png" href="{{ URL::asset('assets/img/favicon.png') }}" />
        <!--jquery-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/jquery-ui.min.css') }}">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <!--bootstrap-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ elixir('assets/css/app.css') }}">
        <link rel="stylesheet" href="{{ elixir('assets/css/extra.css') }}">
        <link rel="stylesheet" href="http://127.0.0.1:8000/resources/css/rug.css') }}">
    </head>
    <body class="display-cards">   
        <!--navigation menu-->
        <div class="container">
        @include('menu')
        </div>
        <!--content-->
        <main>
        @yield('content')
        </main>
        <!--footer-->
        @include('layouts.footer')
        <!--bootstrap script-->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    </body>
</html>