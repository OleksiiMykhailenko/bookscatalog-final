@extends('layouts.layout')

@section('content')
    <h2>Publish a books:</h2>

    <form action="/book" method="post">
        {{csrf_field()}}
        <div class="form-group">
         <label for="title">Title:</label>
            <input class="form-control" type="text" name="title" id="title">
        </div>

        <div class="form-group">
            <label for="alias">Alias:</label>
            <input class="form-control" type="text" name="alias" id="alias">
        </div>

        <div class="form-group">
            <label for="author">Author:</label>
            <input class="form-control" type="text" name="author" id="author">
        </div>

        <div class="form-group">
            <label for="isbn">ISBN:</label>
            <input class="form-control" type="text" name="isbn" id="isbn">
        </div>

        <div class="form-group">
            <label for="intro">Intro:</label>
            <textarea class="form-control" type="text" name="intro" id="intro"></textarea>
        </div>

        <div class="form-group">
            <label for="body">Body:</label>
            <textarea class="form-control" type="text" name="body" id="body"></textarea>
        </div>

        <div class="form-group">
            <button class="btn btn-dark" type="submit">Publish</button>
        </div>

        <div class="container">
            <h1>Add cover</h1>
            <form action="{{ route('image.upload') }}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="form-group">
                <input type="file" name="image">
            </div>
                <button class="btn btn-dark" type="submit">Upload</button>
            </form>
            @isset($path)
                <img class="img-fluid" src="{{asset('/storage/' . $path)}}">
            @endisset
        </div>

    @include('layouts.error')

    </form>

@endsection