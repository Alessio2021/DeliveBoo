<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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
</html>