@extends('layouts.layout')

@section('content')
    <h2>Edit a book:</h2>

    <form action="/books/{{$book->alias}}" method="post">

        {{csrf_field()}}
        {!! method_field('patch') !!}

        <div class="form-group">
         <label for="title">Title:</label>
            <input class="form-control" type="text" name="title" id="title" value="{{$book->title}}">
        </div>

        <div class="form-group">
            <label for="alias">Alias:</label>
            <input class="form-control" type="text" name="alias" id="alias" value="{{$book->alias}}">
        </div>

        <div class="form-group">
            <label for="author">Author:</label>
            <input class="form-control" type="text" name="author" id="author" value="{{$book->author}}">
        </div>

        <div class="form-group">
            <label for="author">ISBN:</label>
            <input class="form-control" type="text" name="isbn" id="isbn" value="{{$book->isbn}}">
        </div>

        <div class="form-group">
            <label for="intro">Intro:</label>
            <textarea class="form-control" type="text" name="intro" id="intro">{{$book->intro}}</textarea>
        </div>

        <div class="form-group">
            <label for="body">Body:</label>
            <textarea class="form-control" type="text" name="body" id="body">{{$book->body}}</textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-dark" type="submit">Update</button>
        </div>

    @include('layouts.error')

    </form>

@endsection