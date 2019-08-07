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

    public function search(Request $request)
    {
        $search = $request->get('search');
        //$books = DB::table('books')->where('title', 'like', '%'.$search.'%')->get();
        $books = Book::where('title', 'like', "%$search%")->get();
        return view('books.show', ['books' => $books]);
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|min:2',
            'alias' => 'required',
            'author' => 'required',
            'isbn' => 'required|unique:books',
            'intro' => 'required',
            'body' => 'required',
            'image' => 'required',
            ]);

        $requestParams = request(['title', 'alias', 'author', 'isbn', 'intro', 'body']);
        $path = $request->file('image')->store('uploads', 'public');
        $storageLink = basename($path);
        $requestParams['cover'] = $storageLink;
        Book::create(
            $requestParams
        );
        return redirect('/');
    }

    public function edit(Book $book)
    {
        return view("books.edit", compact('book'));
    }

    public function update(Book $book, Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|min:2',
            'alias' => 'required',
            'author' => 'required',
            'isbn' => 'required|unique:books',
            'intro' => 'required',
            'body' => 'required',
        ]);
        $requestParams = request(['title', 'alias', 'author', 'isbn', 'intro', 'body']);
        $path = $request->file('image')->store('uploads', 'public');
        $storageLink = basename($path);
        $requestParams['cover'] = $storageLink;
        $book->update($requestParams);
        return redirect('/');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect('/');
    }
}
