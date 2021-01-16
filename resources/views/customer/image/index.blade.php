@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                @include('includes.message')
            </div>
        </div>
        <div class="row">

            <p>
                <a class="btn btn-primary" data-toggle="collapse" href="#FilterByTag" role="button"
                   aria-expanded="false" aria-controls="FilterByTag">
                    Filter by tags
                </a>
            </p>
        </div>
        <div class="row pb-3">
            <div class="col">
                <div class="collapse" id="FilterByTag">
                    <div class="card card-body">
                        <form action="{{route('customer.image.index')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="tag">Tags filter</label>
                                <select class="form-control" id="tags" name="tags[]" multiple>
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}"
                                                @if (in_array($tag->id, $tagsFilter))
                                                selected
                                                @endif
                                        >{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-success">Enter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


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
