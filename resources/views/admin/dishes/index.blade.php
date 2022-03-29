@extends('layouts.admin.app')



@section('content')    

<div class="container d-flex justify-content-center ">
        <div class="row w-100">
            <div class="col">
                {{-- alert status piatto --}}
                @if (session('status'))
                    <div class="alert alert-danger">
                        {{ session('status') }}
                    </div>
                @endif

                <h1 class="mt-5 text-danger">Men&uacute;</h1>
                @foreach ($dishes as $dish)
                <div class="hover-list row py-3 border-bottom border-1 border-primary">
                    <a class="text-info d-block text-decoration-none col-11" href="{{ route('admin.dishes.show', $dish) }}">
                        <div class="row ">
                            <div class="col-8">
                                    <h2 class="fs-3">{{$dish->name}}</h2>
                                    <h5 class="fs-6">{{$dish->created_at}}</h5>
                                
                            </div>
                            <div class="col-4 d-flex justify-content-center align-items-center">
                                <h3 class="fs-5 m-0">{{str_replace(".", ",", $dish->price)}} &euro;</h3>
                            </div>
                        </div>
                    </a>
                    <div class="col-1 d-flex justify-content-center align-items-center">
                        <button type="button" class="btn btn-trasparent shadow-none zoom" data-bs-toggle="modal" data-bs-target="#{{$dish->slug}}">
                        <i class="fs-4 bi text-danger bi-trash3-fill"></i>
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="{{$dish->slug}}" tabindex="-1" aria-labelledby="{{$dish->slug}}Label" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="{{$dish->slug}}Label">Sei sicuro di voler eliminare {{$dish->name}} ?</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                <div class="modal-body">
                                    Una volta eliminato, il piatto no sar&aacute; pi&uacute; presente all'interno della piattaforma.
                                </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('admin.dishes.destroy', $dish)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input class="btn btn-danger" type="submit" value="Elimina">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope='col'>Nome</th>
                        <th scope='col'>Descrizione</th>
                        <th scope='col'>Prezzo</th>
                        <th scope='col'>Img</th>
                        <th scope='col'>Visibilità</th>
                        <th scope='col'>Creato il</th>
                        <th scope='col'>Aggiornato il</th>
                        <th colspan="3" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dishes as $dish)
                        <tr>
                            <td>{{$dish->name}}</td>
                            <td>{{$dish->description}}</td>
                            <td>{{$dish->price}}</td>
                            <td>{{$dish->image}}</td>
                            <td>{{$dish->visibility}}</td>
                            <td>{{$dish->created_at}}</td>
                            <td>{{$dish->updated_at}}</td>
                            <td><a class="btn btn-primary text-info" href="{{ route('admin.dishes.show', $dish) }}">Dettagli</a></td>
                            <td><a class="btn btn-info" href="{{ route('admin.dishes.edit', $dish) }}">Edit</a></td>
                            <td>
                                <button type="button" class="btn btn-trasparent shadow-none zoom" data-bs-toggle="modal" data-bs-target="#{{$dish->slug}}">
                                <i class="bi text-danger bi-trash3-fill"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="{{$dish->slug}}" tabindex="-1" aria-labelledby="{{$dish->slug}}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="{{$dish->slug}}Label">Sei sicuro di voler eliminare {{$dish->name}} ?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        <div class="modal-body">
                                            Una volta eliminato, il piatto no sar&aacute; pi&uacute; presente all'interno della piattaforma.
                                        </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('admin.dishes.destroy', $dish)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input class="btn btn-danger" type="submit" value="Elimina">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table> --}}
                <div class="mt-4 d-flex justify-content-center">
                    {{ $dishes->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

