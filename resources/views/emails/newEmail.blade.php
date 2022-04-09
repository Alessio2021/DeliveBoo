<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container bg-info p-2">
        <div class="row logo-email">
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="bg-success p-5 bg-mail">
                <h1 class="text-primary">{{$lead->message}}</h1>
                <h3 class="fw-bold text-info"> Ristorante:</h3> 
                <p >{{$lead->restaurant_name}}</p>   
                <h4 class="fw-bold text-info"> Email:</h4>
                <p >{{$lead->email}}</p>
                <h4 class="fw-bold text-info">Indirizzo di Spedizione: </h4>  
                <p >{{$lead->guest_address}}</p>     
                <ul class="px-4">
                    @foreach ($data as $dish)
                    <li>
                        <p>{{$dish['name']}} {{$dish['amount']}} x {{$dish['price']}} &euro;</p>
                    </li>
                    @endforeach
                </ul>
                <h3 class="text-info">Totale: {{$lead->amount}} &euro;</h3>
            </div>
        </div>
    </div>
</body>

<style>
    body {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
    .bg-info{
        background-color: #064635;
    }
    .bg-success{
        background-color: #FFF2BD;
    }
    .px-4 {
        padding: 0 10px;
    }
    .p-5 {
        padding: 15px;
    }
    .fw-bold{
        font-weight: bold;
    }
    .container {
        width: 80%;
        margin: auto;
    }
    .bg-mail{
        background-image: url('http://127.0.0.1:8000/img/img-header-deliveboo.png');
        background-position: right;
        background-repeat: no-repeat;
        background-size: 40%
    }
    .logo-email{
        height: 50px;
        background-image: url('http://127.0.0.1:8000/img/logo-deliveboo.svg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: 20%;
    }
    .text-primary{
        color: #EF8D32;
    } 
    .text-secondary{
        color: #CC561E;
    } 
    .text-success{
        color: #FFF2BD;
    } 
    .text-danger{
        color: #AA2B1D;
    } 
    .text-info{
        color: #064635;
    }

</style>
</html>