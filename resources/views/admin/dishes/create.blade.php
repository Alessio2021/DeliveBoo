@extends('layouts.admin.app')

@section('script')
    <script src="{{asset('js/multiImageLoader.js')}}" defer></script>
@endsection

@section('content')
<div class="container mt-2">
  <div class="row">
    <div class="col">
        <div class="text-end">
            <a href="{{ route('admin.dishes.index') }}" class="text-light fw-bold btn btn-primary m-1"><i class="bi bi-arrow-left"></i> Torna al Men&ugrave;</a>
        </div>
        <form action="{{ route('admin.dishes.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            
            {{-- inserimento nome piatto --}}
            <div class="mb-3">
                <label for="nomePiatto" class="form-label">Nome piatto</label>
                <input type="text" class="form-control" id="nomePiatto" name="name" value="{{old('name', '')}}" required>
                {{-- errore --}}
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- descrizione --}}
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <textarea type="text" class="form-control" id="description" name="description" required>{{old('description', '')}}</textarea>
                {{-- errore --}}
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- prezzo --}}
            <div class="mb-3">
                <label for="price" class="form-label" required >Prezzo</label>
                <input type="number" class="form-control" id="price" name="price" value="{{old('price', '')}}">
                {{-- errore --}}
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- immagine DA SISTEMARE - DA SISTEMARE - DA SISTEMARE - DA SISTEMARE - DA SISTEMARE--}}
            <div class="form-group row">
                <label for="image" class="col-12 col-form-label text-md-right">{{ __('Seleziona Foto') }}</label>

                <div id="uploadBox" class="col-12">
                    <div class="row" id="show-images">
                    </div>
                    <div id="show-input-image-upload">
                        <input id="-1" type="file" class="form-control" name="image[]" autocomplete="image">
                    </div>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            {{-- nintendo switch visibilità --}} 
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" 
                {{-- se almeno 1 dei campi e' compilato e c'e' la disponibilita DEselezionata allora metti false ALTRIMENTI checked --}}
                {{ ((old('name')|| old('description') || old('price')) && !old('visibility')) ? "" : 'checked' }}
                name='visibility' value='true'>
                <label class="form-check-label" for="flexSwitchCheckChecked">Disponibilità</label>
            </div>

            {{-- actions --}}
            <div class="mb-3">
                <input class="text-light fw-bold btn btn-primary" type="submit" value="Aggiungi Piatto">
            </div>
        </form>
    </div>
    </div>
</div>
@endsection