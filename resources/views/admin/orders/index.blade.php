@extends('layouts.admin.app')

@section('content')    



<div class="container">
  <h1 class="mt-3 mb-4 text-danger">Ordini Ricevuti</h1>
    <div class="row py-3 ms-2 bg-info opacity-75 text-light">
      <div class=" text-info d-block text-decoration-none col-12">
          <div class="row ">
            <div class="col-1 d-flex justify-content-center align-items-center">
              <h2 class="fs-4 text-light">Nr.</h2>
            </div>
            <div class="col-6">
              <h2 class="fs-4 text-light">Dettagli</h2>
            </div>
            <div class="col-3 d-flex justify-content-center align-items-center">
              <h2 class="fs-4 text-light">Metodo Pagamento</h2>
            </div>
            <div class="col-2 d-flex justify-content-center align-items-center">
              <h2 class="fs-4 text-light">Totale</h2>
            </div>
          </div>
      </div>
  </div>

  @foreach ($restaurantOrders as $key => $order)
    <div class="hover-list row py-3 border-bottom border-1 border-primary ms-2">
        <a class=" text-info d-block text-decoration-none col-12" href="{{route('admin.orders.show', $order->id)}}">
            <div class="row ">
              <div class="col-1 d-flex justify-content-center align-items-center">
                <h4>{{ count($restaurantOrders) - $key }}</h4>
              </div>
              <div class="col-6">
                <h2 class="fs-3">{{$order->guest_address}}</h2>
                <h5 class="fs-6">{{$order->created_at}}</h5>
              </div>
              <div class="col-3 d-flex justify-content-center align-items-center">
                <h5 class="m-0">{{$order->payment_method}}</h5>
              </div>
              <div class="col-2 d-flex justify-content-center align-items-center">
                  <h3 class="fs-5 m-0">{{str_replace(".", ",", $order->total_amount)}} &euro;</h3>
              </div>
            </div>
        </a>
    </div>
  @endforeach

  <div class="mt-4 d-flex justify-content-center">
      {{ $restaurantOrders->links() }}
  </div>
</div>

       
@endsection