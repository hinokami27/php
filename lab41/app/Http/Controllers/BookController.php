<?php

// app/Http/Controllers/BookController.php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // 1. Приказ на сите книги (Index)
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // 2. Форма за додавање нова книга (Create)
    public function create()
    {
        return view('books.create');
    }

    // 3. Зачувување на новата книга (Store)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publication_year' => 'required|integer|min:1000|max:' . date('Y'),
            'isbn' => 'required|string|unique:books|max:20',
            'genre' => 'required|string|max:100',
            // Опционалните не бараат 'required'
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')
            ->with('success', 'Книгата е успешно додадена.');
    }

    // 4. Форма за ажурирање на книга (Edit)
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    // 5. Ажурирање на податоците за книгата (Update)
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publication_year' => 'required|integer|min:1000|max:' . date('Y'),
            'isbn' => 'required|string|max:20|unique:books,isbn,' . $book->id,
            'genre' => 'required|string|max:100',
        ]);

        $book->update($request->all());

        return redirect()->route('books.index')
            ->with('success', 'Податоците за книгата се успешно ажурирани.');
    }

    // 6. Бришење на книгата (Destroy)
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Книгата е успешно избришана.');
    }
}
