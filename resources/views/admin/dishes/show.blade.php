
@extends('layouts.admin.app')

@section('content')
    <div class="mt-5 container ">
        <div class="row">
            <div class="col">
                <h1>{{ $dish->name }}</h1>


                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner" style="height:500px; overflow:hidden; ">
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




                <p>{{ $dish->description }}</p>
                <h4>{{str_replace(".", ",", $dish->price)}} &euro;</h4>
                <h6>Creato il: {{ $dish->created_at }}</h6>
                <h6>Aggiornato il: {{ $dish->updated_at }}</h6>
                <a href="{{ route('admin.dishes.index') }}" class="text-white fw-bold btn btn-primary mt-2"><i class="bi bi-arrow-left"></i> Torna alla Home</a>
                <a class="btn btn-info mt-2" href="{{ route('admin.dishes.edit', $dish) }}">Modifica</a>
            </div>
        </div>
    </div>
@endsection
