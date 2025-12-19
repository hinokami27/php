<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $courses = $query->get(['title', 'level', 'start_date', 'seats', 'id']);
        return view('courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        $course->load('enrollments');
        return view('courses.show', compact('course'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'summary' => 'required',
            'level' => 'required|in:beginner,intermediate,advanced',
            'start_date' => 'required|date',
            'seats' => 'required|integer|min:1'
        ]);

        Course::create($data);
        return redirect()->route('courses.index');
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'title' => 'required',
            'summary' => 'required',
            'level' => 'required|in:beginner,intermediate,advanced',
            'start_date' => 'required|date',
            'seats' => 'required|integer|min:1'
        ]);

        $course->update($data);
        return redirect()->route('courses.show', $course->id);
    }

    public function destroy(Course $course)
    {
        $hasApproved = $course->enrollments()->where('status', 'approved')->exists();

        abort_if($hasApproved, 400, 'Cannot delete course with approved enrollments.');

        $course->delete();
        return redirect()->route('courses.index');
    }
}
