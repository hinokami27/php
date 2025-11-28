<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publication_year',
        'isbn',
        'genre',
        'borrower_name',
        'borrow_date',
        'return_date',
    ];
}
