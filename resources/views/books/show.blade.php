@extends('layouts.layout')

@section('content')

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
            @isset($path)
                <img class="img-fluid" src="{{asset('/storage/' . $path)}}">
            @endisset
        </div>
    </div>


@endsection