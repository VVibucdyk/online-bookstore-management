<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'genre_id',
        'title',
        'author',
        'isbn',
        'publisher',
        'publication_year',
        'description',
        'price',
        'quantity',
        'cover_image',
    ];
}
