@extends('layouts.admin.app')



@section('content')    

       @foreach(App\DishOrder::where('order_id', $restaurantOrder->id)->get() as $dishOrder) 
            <p>{{App\Dish::where('id', $dishOrder->dish_id)->first()->name}} {{$dishOrder->amount}}</p>
       @endforeach
       
@endsection