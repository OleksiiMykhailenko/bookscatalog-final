<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'alias', 'author', 'isbn', 'intro', 'body'];

    public function getRouteKeyName()
    {
        return 'alias';
    }
}
