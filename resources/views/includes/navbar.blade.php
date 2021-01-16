@php
    $route_name = Route::currentRouteName();
@endphp
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">Logo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li
                    @if($route_name=='customer.image.index')
                    class="nav-item active"
                    @else
                    class="nav-item"
                    @endif
            >
                <a class="nav-link" href="{{route('customer.image.index')}}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li
                    @if($route_name=='customer.image.create')
                    class="nav-item active"
                    @else
                    class="nav-item"
                    @endif
            >
                <a class="nav-link" href="{{route('customer.image.create')}}">Create</a>
            </li>
        </ul>
    </div>
</nav>
