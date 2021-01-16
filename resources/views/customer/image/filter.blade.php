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
                        <label for="tags">Tags filter</label>
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
