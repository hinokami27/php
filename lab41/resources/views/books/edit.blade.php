@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>✏️ Ажурирање на Книга: {{ $book->title }}</h2>

        <a class="btn btn-secondary mb-3" href="{{ route('books.index') }}">
            Назад кон листата
        </a>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Грешка!</strong> Има проблем со внесените податоци.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Наслов на книгата</label>
                    <input type="text" name="title" value="{{ old('title', $book->title) }}" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="author" class="form-label">Автор</label>
                    <input type="text" name="author" value="{{ old('author', $book->author) }}" class="form-control" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="publication_year" class="form-label">Година на издавање</label>
                    <input type="number" name="publication_year" value="{{ old('publication_year', $book->publication_year) }}" class="form-control" required max="{{ date('Y') }}" min="1000">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="isbn" class="form-label">ISBN број</label>
                    <input type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="genre" class="form-label">Жанр</label>
                <input type="text" name="genre" value="{{ old('genre', $book->genre) }}" class="form-control" required>
            </div>

            <hr>
            <h5>Опционални Податоци за Изнајмување</h5>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="borrower_name" class="form-label">Име и презиме на лицето што ја изнајмило</label>
                    <input type="text" name="borrower_name" value="{{ old('borrower_name', $book->borrower_name) }}" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="borrow_date" class="form-label">Датум на изнајмување</label>
                    <input type="date" name="borrow_date" value="{{ old('borrow_date', $book->borrow_date) }}" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="return_date" class="form-label">Датум за враќање</label>
                    <input type="date" name="return_date" value="{{ old('return_date', $book->return_date) }}" class="form-control">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Ажурирај книга</button>
        </form>
    </div>
@endsection
