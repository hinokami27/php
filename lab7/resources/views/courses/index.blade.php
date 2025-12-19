@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">Додај нов курс</div>
                <div class="card-body">
                    <form action="{{ route('courses.store') }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label>Наслов</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" required>
                        </div>
                        <div class="mb-2">
                            <label>Краток опис (Summary)</label>
                            <textarea name="summary" class="form-control @error('summary') is-invalid @enderror" required></textarea>
                        </div>
                        <div class="mb-2">
                            <label>Ниво</label>
                            <select name="level" class="form-select">
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advanced">Advanced</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label>Датум на почеток</label>
                            <input type="date" name="start_date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Број на седишта</label>
                            <input type="number" name="seats" class="form-control" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Креирај курс</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Достапни курсеви</h3>
                <form action="{{ route('courses.index') }}" method="GET" class="d-flex w-50">
                    <input type="text" name="search" class="form-control me-2" placeholder="Пребарај по наслов..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-outline-dark">Барај</button>
                </form>
            </div>

            <div class="table-responsive bg-white shadow-sm p-3 rounded">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Наслов</th>
                        <th>Ниво</th>
                        <th>Датум</th>
                        <th>Седишта</th>
                        <th>Акција</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td><strong>{{ $course->title }}</strong></td>
                            <td><span class="badge bg-info text-dark">{{ $course->level }}</span></td>
                            <td>{{ $course->start_date }}</td>
                            <td>{{ $course->seats }}</td>
                            <td>
                                <a href="{{ route('courses.show', $course->id) }}" class="btn btn-sm btn-primary">Детали</a>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Дали сте сигурни?')">Избриши</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
