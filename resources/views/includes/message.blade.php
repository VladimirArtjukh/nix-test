@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>

            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

@if (session('error_message'))
    <div class="alert alert-danger" role="alert">
        {{ session('error_message') }}
    </div>
@endif

