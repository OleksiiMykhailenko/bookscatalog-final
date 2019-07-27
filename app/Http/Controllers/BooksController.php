<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Book;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return view('index', compact('books'));
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function create()
    {
        return view("books.create");
    }

    public function store()
    {
        $this->validate(request(), [
            'title' => 'required|min:2',
            'alias' => 'required',
            'author' => 'required',
            'isbn' => 'required|unique:books',
            'intro' => 'required',
            'body' => 'required',
            ]);

        Book::create(
            request(array('title', 'alias', 'author', 'isbn', 'intro', 'body'))
        );
        return redirect('/');
    }

    public function edit(Book $book)
    {
        return view("books.edit", compact('book'));
    }

    public function update(Book $book)
    {
        $this->validate(request(), [
            'title' => 'required|min:2',
            'alias' => 'required',
            'author' => 'required',
            'isbn' => 'required|unique:books',
            'intro' => 'required',
            'body' => 'required',
        ]);
        $book->update(request(array('title', 'alias', 'author', 'isbn', 'intro', 'body')));
        return redirect('/');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect('/');
    }
}
