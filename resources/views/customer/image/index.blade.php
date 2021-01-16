@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                @include('includes.message')
            </div>
        </div>

        @include('customer.image.filter')

        <div class="row">
            @foreach($images as $image)
                <div class="card col-md-4 text-center mb-3">
                    <img class="card-img-top" src="{{$image->little_image_size}}" alt="{{$image->title}}">
                    <div class="card-body">
                        <p class="card-text">{{$image->title}}</p>
                        <p class="text-muted">
                            @if($image->imageTags != null)
                                @foreach($image->imageTags as $tag)
                                    #{{$tag->name}}
                                @endforeach
                            @endif
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        @include('customer.image.pagination')

    </div>

@endsection
