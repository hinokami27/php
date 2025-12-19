<?php
namespace App\Actions;

use App\Models\Enrollment;

class ApproveEnrollmentAction
{
    /**
     * Извршува одобрување на упис со проверка на достапни места.
     */
    public function execute(Enrollment $enrollment)
    {
        // 1. Проверка дали статусот е pending (барање од задачата)
        abort_if($enrollment->status !== 'pending', 400, 'Само уписи со статус "pending" можат да бидат одобрени.');

        // Земање на курсот поврзан со овој упис
        $course = $enrollment->course;

        // 2. Проверка дали има доволно достапни седишта во курсот
        // Ако бараните седишта се повеќе од достапните, прекини со грешка 400
        abort_if(
            $course->seats < $enrollment->seats_requested,
            400,
            "Нема доволно слободни места во курсот. Достапни: {$course->seats}, Побарани: {$enrollment->seats_requested}."
        );

        // 3. Намалување на седиштата во курсот (барање од задачата)
        $course->seats -= $enrollment->seats_requested;
        $course->save();

        // 4. Промена на статусот во approved
        $enrollment->status = 'approved';
        $enrollment->save();

        return $enrollment;
    }
}
