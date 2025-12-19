@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-warning">Уреди курс</div>
                <div class="card-body">
                    <form action="{{ route('courses.update', $course->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="mb-2">
                            <label>Наслов</label>
                            <input type="text" name="title" class="form-control" value="{{ $course->title }}" required>
                        </div>
                        <div class="mb-2">
                            <label>Опис</label>
                            <textarea name="summary" class="form-control" rows="4" required>{{ $course->summary }}</textarea>
                        </div>
                        <div class="mb-2">
                            <label>Ниво</label>
                            <select name="level" class="form-select">
                                <option value="beginner" {{ $course->level == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="intermediate" {{ $course->level == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="advanced" {{ $course->level == 'advanced' ? 'selected' : '' }}>Advanced</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label>Датум</label>
                            <input type="date" name="start_date" class="form-control" value="{{ $course->start_date }}" required>
                        </div>
                        <div class="mb-3">
                            <label>Преостанати седишта</label>
                            <input type="number" name="seats" class="form-control" value="{{ $course->seats }}" required>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Зачувај промени</button>
                    </form>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-secondary text-white">Нов упис за овој курс</div>
                <div class="card-body">
                    <form action="{{ route('enrollments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <div class="mb-2">
                            <label>Име на студент</label>
                            <input type="text" name="student_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Потребни седишта</label>
                            <input type="number" name="seats_requested" class="form-control" min="1" required>
                        </div>
                        <button type="submit" class="btn btn-outline-primary w-100">Испрати барање за упис</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <h3>Уписи за овој курс</h3>
            <div class="table-responsive bg-white shadow-sm p-3 rounded">
                <table class="table align-middle">
                    <thead>
                    <tr>
                        <th>Студент</th>
                        <th>Седишта</th>
                        <th>Статус</th>
                        <th>Акција</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($course->enrollments as $enrollment)
                        <tr>
                            <td>{{ $enrollment->student_name }}</td>
                            <td>{{ $enrollment->seats_requested }}</td>
                            <td>
                                @if($enrollment->status == 'pending') <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($enrollment->status == 'approved') <span class="badge bg-success">Approved</span>
                                @else <span class="badge bg-danger">Dropped</span>
                                @endif
                            </td>
                            <td>
                                @if($enrollment->status == 'pending')
                                    <form action="{{ route('enrollments.approve', $enrollment->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PUT')
                                        <button class="btn btn-sm btn-success">Одобри</button>
                                    </form>
                                @endif

                                @if($enrollment->status == 'approved')
                                    <form action="{{ route('enrollments.drop', $enrollment->id) }}" method="POST" class="d-inline">
                                        @csrf @method('PUT')
                                        <button class="btn btn-sm btn-outline-danger">Откажи (Drop)</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Нема регистрирани уписи.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
