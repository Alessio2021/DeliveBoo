
@extends('layouts.app')

@section('content')
    <div class="mt-5 container ">
        <div class="row">
            <div class="col">
                <img class="w-25 img-thumbnail" src="{{asset('storage/Dishes/' . $dish->image . '/' . $dish->image . '-1.jpg')}}" alt="{{$dish->name}}">
                <h2>Nome: {{ $dish->name }}</h2>
                <p>Descrizione: {{ $dish->description }}</p>
                <h4>Prezzo: {{ $dish->price }} Euro</h4>
                {{-- <h4>ID: {{ $dish->id }}</h4> --}}
                <h6>Creato il: {{ $dish->created_at }}</h6>
                <h6>Aggiornato il: {{ $dish->updated_at }}</h6>
                <a href="{{ route('admin.dishes.index') }}" class="text-white fw-bold btn btn-primary mt-2">Torna alla Home</a>
            </div>
        </div>
    </div>
@endsection