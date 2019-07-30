<?php

namespace App\Http\Controllers;

use Faker\Provider\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $path = $request->file('image')->store('uploads', 'public');
        return view('books.show', ['path' => $path]);
    }
}
