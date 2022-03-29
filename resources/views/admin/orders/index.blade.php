@extends('layouts.admin.app')



@section('content')    

              

                    @foreach ($restaurantOrders as $order)
                      <a href="{{route('admin.orders.show', $order->id)}}">{{$order->guest_address}} {{$order->payment_method}} {{$order->total_amount}}</a>
                    @endforeach
         

                <div class="mt-4 d-flex justify-content-center">
                    {{ $restaurantOrders->links() }}
                </div>
       
@endsection