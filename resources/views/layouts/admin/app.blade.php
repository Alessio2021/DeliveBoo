<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DeliveBoo') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/front.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <!-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'DeliveBoo') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <-- Left Side Of Navbar -->
                <!-- <ul class="navbar-nav mr-auto">

                </ul> -->

                <!-- Right Side Of Navbar -->
                <!-- <ul class="navbar-nav ml-auto"> -->
                    <!-- Authentication Links -->
                    <!-- @guest
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.dishes.index') }}">Lista Piatti</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.dishes.create') }}">Aggiungi Nuovo Piatto</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div> -->
    <!-- </nav> -->

    <div id="app">
        <main class="container-fluid">
            <div class="row">
                @auth
                <div class="sidebar-width  col-lg-2  p-0 ">
                        @include('layouts.admin.partials.sidebar')
                    </div>
                @endauth
                <div class="{{Auth::id()? 'navbar-width col-lg-10' : 'col-12'}} p-0 admin-header">
                    <nav class="navbar navbar-expand-md navbar-light px-5 justify-content-between flex-nowrap h-100">
                       
                                <a class="navbar-brand d-block w-50  " href="{{ url('/') }}">
                                    <img class="logo-admin" src="{{asset('img/logo-deliveboo.svg')}}" alt="">
                                </a>
                            {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                <span class="navbar-toggler-icon"></span>
                            </button> --}}
                
                            <div class=" justify-content-end" id="navbarSupportedContent">
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav mr-auto">
                                    
                                </ul>
                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ml-auto">
                                    <!-- Authentication Links -->
                                    @guest
                                        <li class="nav-item">
                                            <a class="nav-link text-success fs-5" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link text-success fs-5" href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="nav-item dropdown d-flex flex-column align-items-end justify-content-end-md bg-info rounded-pill p-1">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-success" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                {{ Auth::user()->name }}
                                            </a>
                
                                            <div class="my-position dropdown-menu dropdown-menu-right bg-secondary" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item text-success logout fs-5" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>
                
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>

                                    @endguest
                                </ul>
                            </div>
                        
                    </nav>
                    {{-- <header class="admin-header d-flex align-items-center ps-5">
                        <nav class="navbar navbar-expand-md navbar-light shadow-sm w-100">
                            <div class="container">
                                <a class="navbar-brand d-block w-25" href="{{ url('/') }}">
                                    <img class="h-50" src="{{asset('img/logo-deliveboo.svg')}}" alt="">
                                </a>
                            </div>
                        </nav>
                        
                    </header> --}}
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
</body>
</html>
