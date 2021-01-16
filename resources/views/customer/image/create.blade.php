@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Create new image</h1>
                @include('includes.message')
                <form method="post" action="{{route('customer.image.store')}}"
                      enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title"
                               placeholder="Title" name="title" value="{{ old('title') }}" required autofocus>
                    </div>


                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <select class="form-control" id="tags" name="tags[]" multiple>
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="files" name="files"
                                   accept="image/png, image/jpeg">
                            <label class="custom-file-label" for="files">Choose file</label>
                        </div>
                    </div>

                    <div class="input-group pt-3">
                        <button class="btn btn-success" type="submit">Create</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
@endsection
