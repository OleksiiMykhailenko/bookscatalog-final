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
@endsection
