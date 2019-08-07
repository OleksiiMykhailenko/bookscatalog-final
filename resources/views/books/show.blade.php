@extends('layouts.layout')

@section('content')

    @if(!isset($books))
    <div class="row">
        <div class="col-md-8 blog-main">
            <div class="book-post">
                <h2 class="book-post-title">{{$book->title}}</h2>
                <h5 class="book-post-author">{{$book->author}}</h5>
                <p>{{$book->isbn}}</p>
                <p>{{$book->body}}</p>
            </div>
        </div>
        <div>
            @isset($book->cover)
                <img class="img-fluid" src="/storage/uploads/{{$book->cover}}">
            @endisset
        </div>
    </div>
    @else
        @foreach($books as $book)
            <div class="row">
                <div class="col-md-8 blog-main">
                    <div class="book-post">
                        <h2 class="book-post-title">{{$book->title}}</h2>
                        <h5 class="book-post-author">{{$book->author}}</h5>
                        <p>{{$book->isbn}}</p>
                        <p>{{$book->body}}</p>
                    </div>
                </div>
                <div>
                    @isset($book->cover)
                        <img class="img-fluid" src="/storage/uploads/{{$book->cover}}">
                    @endisset
                </div>
            </div>
        @endforeach
    @endif

    <h5>Add comment:</h5>

    <form action="/book" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="title">Title:</label>
            <input class="form-control" type="text" name="title" id="title">
        </div>
        <div class="form-group">
            <label for="body">Body:</label>
            <textarea class="form-control" type="text" name="body" id="body"></textarea>
        </div>
        <div class="form-group">
            <button class="btn btn-dark" type="submit">Publish</button>
        </div>
    </form>

@endsection
