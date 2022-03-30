@extends('layouts.admin.app')



@section('content')    

<div class="container">
     <h1 class="mt-3 mb-4 text-danger">Dettaglio Ordine</h1>
     <div class="row py-3 ms-2 bg-info opacity-75 text-light">
          <div class=" text-info d-block text-decoration-none col-12">
               <div class="row ">
                    <div class="col-2 d-flex align-items-center">
                         <h2 class="fs-4 text-light">Quantit&agrave;</h2>
                    </div>
                    <div class="col-6 d-flex align-items-center">
                         <h2 class="fs-4 text-light">Piatto</h2>
                    </div>
                    <div class="col-2 d-flex justify-content-center align-items-center">
                         <h2 class="fs-4 text-light">Prezzo</h2>
                    </div>
                    <div class="col-2 d-flex justify-content-center align-items-center">
                         <h2 class="fs-4 text-light">Totale Piatto</h2>
                    </div>
               </div>
          </div>
     </div>

     <div class="border-bottom border-1 border-info">
          @foreach (App\DishOrder::where('order_id', $restaurantOrder->id)->get() as $dishOrder)
               <div class="row py-3 ms-2">
                    <div class="text-info d-block text-decoration-none col-12">
                         <div class="row ">
                              <div class="col-2 d-flex align-items-center">
                                   <h3 class="fs-4 m-0">{{$dishOrder->amount}}</h3>
                              </div>
                              <div class="col-6 d-flex align-items-center">
                                   <h3 class="fs-4 m-0">{{App\Dish::where('id', $dishOrder->dish_id)->first()->name}}</h3>
                              </div>
                              <div class="col-2 d-flex justify-content-center align-items-center">
                                   <h3 class="fs-4 m-0">{{str_replace(".", ",", $dishOrder->history_price)}} &euro;</h3>
                              </div>
                              <div class="col-2 d-flex justify-content-center align-items-center">
                                   <h3 class="fs-4 m-0">{{number_format($dishOrder->history_price * $dishOrder->amount, 2,',', '.')}} &euro;</h3>
                              </div>
                         </div>
                    </div>
               </div>
          @endforeach
     </div>
     <div class="row py-3 ms-2 ">
          <div class="col-6">
               <h3 class="text-info d-flex align-items-center">Totale</h3>
          </div>
          <div class="col-6 d-flex justify-content-end align-items-center">
               <h3 class="text-danger me-4 pe-4">{{str_replace(".", ",", $restaurantOrder->total_amount)}} &euro;</h3>
          </div>
     </div>
</div>

@endsection