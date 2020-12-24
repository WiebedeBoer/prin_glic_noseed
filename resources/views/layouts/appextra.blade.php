<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="cleartype" content="on">
    <!-- Responsive and mobile friendly stuff -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--title-->
    <title>PRIN6 @yield('title', 'PRIN6')</title>
    <!-- Scripts -->
    <script src="{{ asset('assets/js/app.js') }}" defer></script>
    <script src="{{ asset('assets/js/jquery.slight-submenu.js') }}" defer></script>
    <!-- Fonts -->

    <!--favicon-->
    <link rel="icon" type="image/png" href="{{ URL::asset('assets/images/favicon.png') }}" />  
    <!--external stylesheets-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/slight-submenu.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/jquery-ui.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/extra.css') }}">       
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">  
    <!--uitleg-->
    <link rel="stylesheet" href="{{ asset('assets/css/hover.css') }}">   
</head>
<body>
<header>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    PRIN6
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

    <!--</div>-->        
        <!--navigation menu-->
        <div class="main-menu">
        <div class="container">
            @include('menu')
        </div>
        </div>
</header>       
        <!--main content-->
            <main>
                <div class="rug-panel--content rug-panel--content--border">
                    <h1 class="rug-mb-0 rug-clearfix">
                        @yield('pagename')
                    </h1>
                </div>
                @yield('submenu')
                <div class="rug-clearfix rug-theme--content rug-mb">
                    <div class="project-more-info">
                        <div class="project-period-items">
                            <div class="project-period-item">
                                        @yield('addcontent')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="rug-clearfix rug-theme--content rug-mb">
                    <div class="project-more-info">
                        <div class="project-period-items">
                            <div class="project-period-item">
                                        @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
                @yield('addition')
            </main>
        <!--footer-->
        @include('layouts.footer')       
        <!--bootstrap script-->
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!--jquery lightbox elixir scripts-->
        <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
        <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
</body>
</html>