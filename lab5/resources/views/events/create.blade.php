@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>✍️ Креирај нов Настан</h2>

        <form action="{{ route('events.store') }}" method="POST">
            @csrf

            {{-- Име на Настанот --}}
            <div class="form-group mb-3">
                <label for="name">Име на Настанот:</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Опис (мин. 20 карактери) --}}
            <div class="form-group mb-3">
                <label for="description">Краток Опис (мин. 20 карактери):</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Тип на Настан --}}
            <div class="form-group mb-3">
                <label for="type">Тип на Настанот:</label>
                <input type="text" class="form-control @error('type') is-invalid @enderror" id="type" name="type" value="{{ old('type') }}" required>
                @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Датум и Време (Не во минатото) --}}
            <div class="form-group mb-3">
                <label for="date_time">Датум и Време:</label>
                <input type="datetime-local" class="form-control @error('date_time') is-invalid @enderror" id="date_time" name="date_time" value="{{ old('date_time') }}" required>
                @error('date_time')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Организатор (Потребно е да се избере) --}}
            <div class="form-group mb-3">
                <label for="organizer_id">Организатор:</label>
                <select class="form-control @error('organizer_id') is-invalid @enderror" id="organizer_id" name="organizer_id" required>
                    <option value="">-- Избери Организатор --</option>
                    @foreach ($organizers as $organizer)
                        <option value="{{ $organizer->id }}" {{ old('organizer_id') == $organizer->id ? 'selected' : '' }}>
                            {{ $organizer->full_name }}
                        </option>
                    @endforeach
                </select>
                @error('organizer_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Зачувај Настан</button>
            <a href="{{ route('events.index') }}" class="btn btn-secondary">Откажи</a>
        </form>
    </div>
@endsection
