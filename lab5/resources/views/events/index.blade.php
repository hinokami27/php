@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Листа на Настани</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-3">
            <a href="{{ route('events.create') }}" class="btn btn-primary">➕ Креирај нов Настан</a>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Име на Настанот</th>
                <th>Тип</th>
                <th>Датум и Време</th>
                <th>Организатор</th>
                <th>Акции</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($events as $event)
                <tr>
                    <td>{{ $event->id }}</td>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->type }}</td>
                    <td>{{ $event->date_time->format('d.m.Y H:i') }}</td>
                    <td>{{ $event->organizer->full_name ?? 'Непознат' }}</td>
                    <td>
                        <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-info">Прикажи</a>
                        <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-warning">Уреди</a>
                        <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Дали сте сигурни дека сакате да го избришете настанот?')">Избриши</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Нема пронајдени настани.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{-- Пагинација --}}
        <div class="mt-3">
            {{ $events->links() }}
        </div>
    </div>
@endsection
