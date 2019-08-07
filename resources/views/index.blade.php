@extends('layouts.layout')

@section('content')

    <div class="row">

        @foreach($books as $book)

            <div class="col-md-4">
                <h2>{{ $book->title }}</h2>
                <p>{{ $book->author }}</p>
                <p>{{ $book->intro }}</p>
                @if (\Illuminate\Support\Facades\Auth::user()->canVIew())

                    <p><a href="/books/{{$book->alias}}" class="btn btn-dark">Read more</a></p>
                @endif
                <p><a href="/books/{{$book->alias}}/edit" class="btn btn-outline-dark">Edit</a></p>
                <form action="/books/{{$book->alias}}" method="post">
                    {{csrf_field()}}
                    {!! method_field('delete') !!}
                    @if (\Illuminate\Support\Facades\Auth::user()->canEdit())
                        <button type="submit" class="btn btn-outline-dark">Delete</button>
                    @endif
                </form>
            </div>

        @endforeach

    </div>

@endsection