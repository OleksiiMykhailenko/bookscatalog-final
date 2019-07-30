<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
 * GET /books
 * GET /books/create
 * POST /books
 * GET /books/{id}/edit
 * PATCH /books/{id}
 * GET /books/{id}
 * DELETE /books/{ID}
 */

Route::get('/', "BooksController@index");

Route::get('/search', "BooksController@search");

Route::get('/books/create', "BooksController@create");

Route::get('/books/{book}', "BooksController@show");

Route::post('/book', "BooksController@store");

Route::get('/books/{book}/edit', "BooksController@edit");

Route::patch('/books/{book}', "BooksController@update");

Route::delete('/books/{book}', "BooksController@destroy");

Route::post('/image/upload', "ImageController@upload")->name('image.upload');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
