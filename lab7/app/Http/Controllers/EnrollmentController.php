<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Actions\ApproveEnrollmentAction;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'student_name' => 'required',
            'seats_requested' => 'required|integer|min:1'
        ]);

        // Статусот автоматски е pending преку default во миграција или експлицитно:
        $data['status'] = 'pending';

        Enrollment::create($data);
        return back();
    }

    public function approve(Enrollment $enrollment, ApproveEnrollmentAction $action)
    {
        $action->execute($enrollment);
        return back();
    }

    public function drop(Enrollment $enrollment)
    {
        abort_if($enrollment->status !== 'approved', 400, 'Only approved enrollments can be dropped.');

        $enrollment->update(['status' => 'dropped']);
        return back();
    }
}
