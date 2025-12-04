@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>✏️ Уреди Организатор: {{ $organizer->full_name }}</h2>

        <form action="{{ route('organizers.update', $organizer) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Име и Презиме --}}
            <div class="form-group mb-3">
                <label for="full_name">Име и Презиме:</label>
                <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name', $organizer->full_name) }}" required>
                @error('full_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="form-group mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $organizer->email) }}" required>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Телефонски Број --}}
            <div class="form-group mb-3">
                <label for="phone_number">Телефонски број:</label>
                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $organizer->phone_number) }}" required>
                @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Ажурирај Организатор</button>
            <a href="{{ route('organizers.index') }}" class="btn btn-secondary">Откажи</a>
        </form>
    </div>
@endsection
