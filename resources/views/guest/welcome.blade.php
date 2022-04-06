<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>
        <script>const localHost ='{{$appUrl}}'; </script>
        <script src="{{asset('js/front.js')}}" defer></script>
        <script src="https://js.braintreegateway.com/web/dropin/1.33.0/js/dropin.min.js"></script>
        <script src="https://js.braintreegateway.com/web/3.85.2/js/client.min.js"></script>
        <script src="https://js.braintreegateway.com/web/3.85.2/js/data-collector.min.js"></script>

        @if (session('status') == 'Pagamento Effettuato')
            <script defer>
                localStorage.removeItem('key');
            </script>
        @endif

          
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/front.css') }}"> 
    </head>
    <body class="bg-white">
        <div id="payment-form-checkout" class="d-none w-50 container">
            <form id="payment-form"  class="row" action="{{route('payment')}}" method="post">
                @csrf
                @method('POST')
                <div id="dropin-container" class="col-6"></div>
                <input type="hidden" id="JSONOrder" name="data" value="">
                <input type="hidden" id="nonce" name="payment_method_nonce"/>
                <div class="col-6 mt-5">
                    <label for="email" class="form-label">Inserisci la tua mail</label>
                    <input class="form-control" type="email" required id="email" name="guest_email"/>
                    <label for="address" class="form-label">Inserisci l'indirizzo di consegna</label>
                    <input type="text" required id="address" name="address" class="form-control"/>
                </div>
                <input type="hidden" id="card_type" name="card_type">
                <button class="btn btn-primary text-light">Paga</button>
            </form>
        </div>
        
    <ul class="navbar-nav ml-auto auth-links gap-3 pt-3">
    @guest
        <li class="nav-item bg-info rounded-pill px-sm-3 px-2 shadow">
            <a class="nav-link text-yellow " href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
        <li class="nav-item bg-info rounded-pill px-sm-2 px-1 shadow">
            <a class="nav-link text-yellow" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
        @endif
        @else
        <li class="nav-item dropdown d-flex flex-column align-items-end justify-content-end-md ">
            <a id="navbarDropdown" class="nav-link dropdown-toggle text-success " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>{{ Auth::user()->name }}</a>
            <div class="my-position dropdown-menu dropdown-menu-right bg-secondary my-position" aria-labelledby="navbarDropdown">
                <a class="dropdown-item text-success logout fs-5" href="{{ route('admin.home') }}">{{ __('Area Personale') }}</a>
                <a class="dropdown-item text-success logout fs-5" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                </form>
            </div>
        </li>
        @endguest
    </ul>

    @if (session('status'))
        <div class="alert m-0 {{(session('status') == 'Pagamento Effettuato') ? 'alert-info' : 'alert-danger'}}">
            {{ session('status') }}
        </div>
    @endif

    <div id="app" class="content">
                
    </div>
</div>
</body>
</html>
