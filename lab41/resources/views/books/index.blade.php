@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>📚 Управување со Книги</h2>

{{--        @if ($message = Session::get('success'))--}}
{{--            <div class="alert alert-success">--}}
{{--                <p>{{ $message }}</p>--}}
{{--            </div>--}}
{{--        @endif--}}

        <a href="{{ route('books.create') }}" class="btn btn-success mb-3">
            Додади книга
        </a>

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Наслов</th>
                <th>Автор</th>
                <th>Година</th>
                <th>ISBN</th>
                <th>Жанр</th>
                <th>Изнајмено од</th>
                <th>Датум на изнајмување</th>
                <th>Датум за враќање</th>
                <th width="180px">Акција</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->publication_year }}</td>
                    <td>{{ $book->isbn }}</td>
                    <td>{{ $book->genre }}</td>
                    <td>{{ $book->borrower_name ?? '-' }}</td>
                    <td>{{ $book->borrow_date ?? '-' }}</td>
                    <td>{{ $book->return_date ?? '-' }}</td>
                    <td>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                            <a class="btn btn-primary btn-sm" href="{{ route('books.edit', $book->id) }}">
                                Ажурирај
                            </a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Дали сте сигурни дека сакате да ја избришете оваа книга?')">
                                Избриши
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Нема внесени книги.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
