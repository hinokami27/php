@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>✏️ Уреди Настан: {{ $event->name }}</h2>

        <form action="{{ route('events.update', $event) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Име на Настанот --}}
            <div class="form-group mb-3">
                <label for="name">Име на Настанот:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $event->name) }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Опис (мин. 20 карактери) --}}
            <div class="form-group mb-3">
                <label for="description">Краток Опис (мин. 20 карактери):</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description', $event->description) }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Тип на Настан --}}
            <div class="form-group mb-3">
                <label for="type">Тип на Настанот:</label>
                <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type', $event->type) }}" required>
                @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Датум и Време --}}
            <div class="form-group mb-3">
                <label for="date_time">Датум и Време:</label>
                {{-- Форматирањето е потребно за datetime-local да работи со постоечка вредност --}}
                <input type="datetime-local" class="form-control @error('date_time') is-invalid @enderror" id="date_time" name="date_time" value="{{ old('date_time', $event->date_time ? $event->date_time->format('Y-m-d\TH:i') : '') }}" required>
                @error('date_time')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Организатор --}}
            <div class="form-group mb-3">
                <label for="organizer_id">Организатор:</label>
                <select class="form-control @error('organizer_id') is-invalid @enderror" id="organizer_id" name="organizer_id" required>
                    <option value="">-- Избери Организатор --</option>
                    @foreach ($organizers as $organizer)
                        <option value="{{ $organizer->id }}" {{ old('organizer_id', $event->organizer_id) == $organizer->id ? 'selected' : '' }}>
                            {{ $organizer->full_name }}
                        </option>
                    @endforeach
                </select>
                @error('organizer_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Ажурирај Настан</button>
            <a href="{{ route('events.index') }}" class="btn btn-secondary">Откажи</a>
        </form>
    </div>
@endsection
