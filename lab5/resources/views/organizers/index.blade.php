@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Листа на Организатори</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-3">
            <a href="{{ route('organizers.create') }}" class="btn btn-primary">➕ Креирај нов Организатор</a>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Име и Презиме</th>
                <th>Email</th>
                <th>Телефон</th>
                <th>Акции</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($organizers as $organizer)
                <tr>
                    <td>{{ $organizer->id }}</td>
                    <td>{{ $organizer->full_name }}</td>
                    <td>{{ $organizer->email }}</td>
                    <td>{{ $organizer->phone_number }}</td>
                    <td>
                        <a href="{{ route('organizers.show', $organizer) }}" class="btn btn-sm btn-info">Прикажи</a>
                        <a href="{{ route('organizers.edit', $organizer) }}" class="btn btn-sm btn-warning">Уреди</a>
                        <form action="{{ route('organizers.destroy', $organizer) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Дали сте сигурни дека сакате да го избришете организаторот?')">Избриши</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Нема пронајдени организатори.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

{{--         Пагинација--}}
        <div class="mt-3">
            {{ $organizers->links() }}
        </div>
    </div>
@endsection
