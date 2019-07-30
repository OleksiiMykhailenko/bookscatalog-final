<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'alias', 'author', 'isbn', 'intro', 'body', 'cover'];

    public function getRouteKeyName()
    {
        return 'alias';
    }
}
