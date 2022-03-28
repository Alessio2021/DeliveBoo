@extends('layouts.app')

@section('content')    
    <div class="container">
        <div class="row">
            <div class="col">
                {{-- alert status piatto --}}
                @if (session('status'))
                    <div class="alert alert-danger">
                        {{ session('status') }}
                    </div>
                @endif
                    <img src="{{asset('storage/' . App\User::where('id', Auth::id())->first()->image)}}" alt="">
                <table class="table table-striped">
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
                            <td><a class="btn btn-primary" href="{{ route('admin.dishes.show', $dish) }}">View</a></td>
                            <td><a class="btn btn-info" href="{{ route('admin.dishes.edit', $dish) }}">Edit</a></td>
                            <td>

                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#{{$dish->slug}}">
                                Cancella
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="{{$dish->slug}}" tabindex="-1" aria-labelledby="{{$dish->slug}}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="{{$dish->slug}}Label">Eliminazione</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                        <div class="modal-body">
                                            Sei sicuro di voler eliminare {{$dish->name}} ?
                                        </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form action="{{ route('admin.dishes.destroy', $dish)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input class="btn btn-danger" type="submit" value="Cancella">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
                <div>
                    {{ $dishes->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection