@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>ℹ️ Детали за Организаторот: {{ $organizer->full_name }}</h2>

        <div class="card mb-4">
            <div class="card-body">
                <p><strong>ID:</strong> {{ $organizer->id }}</p>
                <p><strong>Име и Презиме:</strong> {{ $organizer->full_name }}</p>
                <p><strong>Email:</strong> {{ $organizer->email }}</p>
                <p><strong>Телефонски број:</strong> {{ $organizer->phone_number }}</p>
                <p><strong>Креиран на:</strong> {{ $organizer->created_at->format('d.m.Y H:i') }}</p>
            </div>
        </div>

        <h3>Настани организирани од {{ $organizer->full_name }} ({{ $organizer->events->count() }})</h3>

        @forelse ($organizer->events as $event)
            <div class="card mb-2">
                <div class="card-body">
                    <h5>{{ $event->name }} ({{ $event->type }})</h5>
                    <p>Датум: {{ $event->date_time->format('d.m.Y H:i') }}</p>
                    <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-outline-info">Види детали за настанот</a>
                </div>
            </div>
        @empty
            <p>Овој организатор нема пријавено настани.</p>
        @endforelse

        <div class="mt-4">
            <a href="{{ route('organizers.index') }}" class="btn btn-secondary">← Назад кон листата</a>
            <a href="{{ route('organizers.edit', $organizer) }}" class="btn btn-warning">Уреди</a>
        </div>
    </div>
@endsection
