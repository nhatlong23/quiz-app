<?php

namespace App\Policies;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExamPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->checkPermissionAccess('exams.index')
            ? Response::allow()
            : Response::deny('You are not authorized to view exams.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess('exams.create')
            ? Response::allow()
            : Response::deny('You are not authorized to create exams.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess('exams.edit')
            ? Response::allow()
            : Response::deny('You are not authorized to update exams.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess('exams.destroy')
            ? Response::allow()
            : Response::deny('You are not authorized to delete exams.');
    }

    public function quick_view_exam(User $user)
    {
        return $user->checkPermissionAccess('quick_view_exam')
            ? Response::allow()
            : Response::deny('You are not authorized to view exams.');
    }

    public function exams_request(User $user)
    {
        return $user->checkPermissionAccess('exams_request')
            ? Response::allow()
            : Response::deny('You are not authorized to view exams.');
    }

    public function addExamToClass(User $user)
    {
        return $user->checkPermissionAccess('addExamToClass')
            ? Response::allow()
            : Response::deny('You are not authorized to view exams.');
    }

    public function updateStatusExams(User $user)
    {
        return $user->checkPermissionAccess('updateStatusExams')
            ? Response::allow()
            : Response::deny('You are not authorized to view exams.');
    }

    public function deleteQuestionFromExam(User $user)
    {
        return $user->checkPermissionAccess('deleteQuestionFromExam')
            ? Response::allow()
            : Response::deny('You are not authorized to view exams.');
    }
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Exam $exam)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Exam $exam)
    {
        //
    }
}
