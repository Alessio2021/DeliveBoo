<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <script src="{{asset('js/front.js')}}" defer></script>
        <script>let localHost ='{{$appUrl}}'</script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .auth-links{
                position: absolute;
                z-index: 1;
                flex-direction: row !important;
                top: 10px;
                right: 10%;
            }
            .text-yellow{
                color: #FFF2BD !important;
            }
        </style>
        
    </head>
    <body>
    <ul class="navbar-nav ml-auto auth-links gap-3 pt-3">
    @guest
        <li class="nav-item">
            <a class="nav-link text-yellow fs-6" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link text-yellow fs-6" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown d-flex flex-column align-items-end justify-content-end-md ">
            <a id="navbarDropdown" class="nav-link dropdown-toggle text-success" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ Auth::user()->name }}</a>
            <div class="my-position dropdown-menu dropdown-menu-right bg-secondary my-position" aria-labelledby="navbarDropdown">
                <a class="dropdown-item text-success logout fs-5" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                </form>
            </div>
        </li>
        @endguest
    </ul>

    <div id="app" class="content">
                
    </div>
</div>
</body>
</html>
