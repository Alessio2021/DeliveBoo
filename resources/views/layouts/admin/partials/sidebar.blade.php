<div class="d-flex flex-column align-items-center p-3 vh-100 bg-info ">
    <div class="min-try w-100 border border-danger overflow-hidden">
        <img class="w-100" src="{{asset('storage/' . App\User::where('id', Auth::id())->first()->image)}}" alt="">
    </div>
    <div>
        <a href="/" class="text-danger mt-2 d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
            {{-- <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg> --}}
            <h3 class="fs-4 d-none d-lg-inline-block ">{{ App\User::where('id', Auth::id())->first()->name }}</h3>
        </a>
    </div>
    <hr>
    <ul class=" nav nav-pills flex-column mb-auto font10">
        <li class="nav-item">
        <a href="{{ route('admin.home') }}" class="nav-link {{Route::currentRouteName() == 'admin.home' ? 'active' : 'link-primary'}}" aria-current="page">
            <i class="bi bi-house-door-fill"></i>
            <span class=" d-none d-lg-inline-block ms-3">Home</span>
        </a>
        </li>
        <li>
        <a href="{{ route('admin.dishes.index') }}" class="nav-link {{Route::currentRouteName() == 'admin.dishes.index' ? 'active' : 'link-primary'}}">
            <i class="fas fa-utensils"></i>
            <span class=" d-none d-lg-inline-block ms-3">Lista Piatti</span>
        </a>
        </li>
        <li>
        <a href="{{route('admin.orders.index')}}" class="nav-link {{(Route::currentRouteName() == 'admin.orders.index' || Route::currentRouteName() == 'admin.orders.show') ? 'active' : 'link-primary'}}">
            <i class="fas fa-list-ul"></i>
            <span class=" d-none d-lg-inline-block ms-3">Ordini</span>
        </a>
        </li>
        <li>
        <a href="{{ route('admin.dishes.create') }}" class="nav-link d-flex align-items-center {{Route::currentRouteName() == 'admin.dishes.create' ? 'active' : 'link-primary'}}">
            <i class="fas fa-plus"></i>
            <span class="d-none d-lg-inline-block ms-3" >Aggiungi Piatto</span>
        </a>
        </li>
        <li>
        <a href="{{ route('admin.stats') }}" class="nav-link d-flex align-items-center {{Route::currentRouteName() == 'admin.stats' ? 'active' : 'link-dark'}}" class="nav-link">
            <i class="fas fa-chart-bar"></i>
            <span class=" d-none d-lg-inline-block ms-3">Statistiche</span>
        </a>
        </li>
    </ul>
    {{-- <hr>
    <div class="dropdown ">
        <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="{{asset('storage/' . App\User::where('id', Auth::id())->first()->image)}}" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong>mdo</strong>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
        <li><a class="dropdown-item" href="#">New project...</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#">Sign out</a></li>
        </ul>
    </div> --}}
</div>