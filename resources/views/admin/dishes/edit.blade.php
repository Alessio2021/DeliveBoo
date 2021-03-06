@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="row">
    <div class="col">
        <form action="{{ route('admin.dishes.update', $dish) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            {{-- inserimento nome piatto --}}
            <div class="mb-3">
                <label for="nomePiatto" class="form-label">Nome piatto</label>
                <input type="text" class="form-control" id="nomePiatto" value="{{ old('name') ? old('name') : $dish->name }}" name="name">
                {{-- errore --}}
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- descrizione --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea type="text" class="form-control" id="description"  name="description">{{$dish->description}}'</textarea>
                {{-- errore --}}
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- prezzo --}}
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo</label>
                <input type="number" class="form-control" id="price" value="{{ $dish->price }}" name="price">
                {{-- errore --}}
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- immagine DA SISTEMARE - DA SISTEMARE - DA SISTEMARE - DA SISTEMARE - DA SISTEMARE--}}
            <div class="mb-3">
                <label for="image" class="form-label">Seleziona File</label>
                <input class="form-control" type="file" id="image" name="image">
                {{-- errore --}}
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- nintendo switch visibilit?? --}}
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{$dish->visibility ? 'checked' : ""}} name='visibility' value='true'>
                <label class="form-check-label" for="flexSwitchCheckChecked">Disponibilit??</label>
            </div>

            {{-- actions --}}
            <div class="mb-3">
                <a href="{{ route('admin.dishes.index') }}" class="text-light fw-bold btn btn-primary m-1">Back</a>
                <input class="text-light fw-bold btn btn-primary" type="submit" value="Send">
            </div>
        </form>
    </div>
    </div>
</div>
@endsection