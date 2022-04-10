@extends('layouts.admin.app')



@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header fs-5 text-info bg-primary">{{ __('Registra il tuo ristorante su DeliveBoo!') }}</div>

                <div class="card-body bg-success">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row ">
                            <label for="name" class="col-md-4 col-form-label text-md-right fs-6 text-info">{{ __('Nome Attività') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- CHECKBOX --}}
                        

                        <legend class="fs-6 text-info mt-3">Categoria:</legend>
                        <fieldset class="row ms-5 mb-4">
                            @foreach (App\Category::all() as $category)
                                <div class="form-check col-4 mb-2">
                                    {{-- scrivo nel name tags[] perché passo piu elementi alla store che cosi me li raggruppa  --}}
                                    <input class="form-check-input" type="checkbox" value="{{ $category->id }}" name="categories[]"
                                    {{-- ternario per lasciare la checkbox ceccata durante l'errore --}}
                                    {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}
                                    >
                                    <label class="form-check-label text-capitalize" for="flexCheckDefault">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </fieldset>

                        {{-- EMAIL --}}
                        <div class="form-group row mb-2">
                            <label for="email" class="col-md-4 col-form-label text-md-right fs-6 text-info">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- INDIRIZZO --}}
                        <div class="form-group row mb-2">
                            <label for="address" class="col-md-4 col-form-label text-md-right fs-6 text-info">{{ __('Indirizzo') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- P IVA --}}
                        <div class="form-group row mb-2">
                            <label for="PIVA" class="col-md-4 col-form-label text-md-right fs-6 text-info">{{ __('Partita IVA') }}</label>

                            <div class="col-md-6">
                                <input id="PIVA" type="text" class="form-control @error('PIVA') is-invalid @enderror" name="PIVA" value="{{ old('PIVA') }}" required autocomplete="PIVA">

                                @error('PIVA')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- FOTO --}}
                        <div class="form-group row mb-2">
                            <label for="image" class="col-md-4 col-form-label text-md-right fs-6 text-info">{{ __('Seleziona Foto') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" autocomplete="image">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- PASSWORD --}}
                        <div class="form-group row mb-2">
                            <label for="password" class="col-md-4 col-form-label text-md-right fs-6 text-info">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right fs-6 text-info">{{ __('Conferma Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrati') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
