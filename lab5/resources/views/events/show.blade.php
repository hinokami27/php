@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>🔍 Детали за Настанот: {{ $event->name }}</h2>

        <div class="card mb-4">
            <div class="card-body">
                <p><strong>ID:</strong> {{ $event->id }}</p>
                <p><strong>Име:</strong> {{ $event->name }}</p>
                <p><strong>Тип:</strong> {{ $event->type }}</p>
                <p><strong>Датум и Време:</strong> {{ $event->date_time->format('d.m.Y H:i') }}</p>
                <p><strong>Организатор:</strong>
                    <a href="{{ route('organizers.show', $event->organizer_id) }}">
                        {{ $event->organizer->full_name ?? 'Непознат' }}
                    </a>
                </p>
                <hr>
                <p><strong>Опис:</strong></p>
                <p>{{ $event->description }}</p>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('events.index') }}" class="btn btn-secondary">← Назад кон листата</a>
            <a href="{{ route('events.edit', $event) }}" class="btn btn-warning">Уреди</a>
        </div>
    </div>
@endsection
