@extends('layouts.layout')

@section('content')

    <div class="row">

        @foreach($books as $book)

            <div class="col-md-4">
                <h2>{{ $book->title }}</h2>
                <p>{{ $book->author }}</p>
                <p>{{ $book->intro }}</p>
                @guest
                    <p><a href="/books/{{$book->alias}}" class="btn btn-dark">Read more</a></p>
                @else
                    <p><a href="/books/{{$book->alias}}" class="btn btn-dark">Read more</a></p>
                    @if (\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                    <p><a href="/books/{{$book->alias}}/edit" class="btn btn-outline-dark">Edit</a></p>
                    @endif
                <form action="/books/{{$book->alias}}" method="post">
                    {{csrf_field()}}
                    {!! method_field('delete') !!}
                    @if (\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                        <button type="submit" class="btn btn-outline-dark">Delete</button>
                    @endif
                    @endauth
                </form>
            </div>

        @endforeach

    </div>

@endsection