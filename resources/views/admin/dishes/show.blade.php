
@extends('layouts.admin.app')

@section('content')
    <div class="mt-3 container ">
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-between">
                    <h1>{{ $dish->name }}</h1>
                    <div class="text-end">
                        <a class="btn btn-info" href="{{ route('admin.dishes.edit', $dish) }}">Modifica</a>
                        <a href="{{ route('admin.dishes.index') }}" class="text-light fw-bold btn btn-primary m-1"><i class="bi bi-arrow-left"></i> Torna al Men&ugrave;</a>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                <div class="w-75">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach (App\DishImage::where('dish_id', $dish->id)->get() as $key=>$image)
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}" class="{{$key==0 ? 'active' : ""}}" aria-current="true" aria-label="Slide 1"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner bg-dark" style="height:60vh; overflow:hidden; ">
                            @foreach (App\DishImage::where('dish_id', $dish->id)->get() as $key=>$image)
                                <div class="h-100 carousel-item {{$key==0 ? 'active' : ""}}" style="position:relative" >
                                    <img class="w-100" src="{{asset('storage/' . $image->img_path)}}" alt="" style="transform:translateY(-50%); top:50%; position:absolute;">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>




                <p>{{ $dish->description }}</p>
                <h4>{{str_replace(".", ",", $dish->price)}} &euro;</h4>
                <h6>Creato il: {{ $dish->created_at }}</h6>
                <h6>Aggiornato il: {{ $dish->updated_at }}</h6>
            </div>
        </div>
    </div>
@endsection
