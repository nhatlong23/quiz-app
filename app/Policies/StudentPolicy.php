<?php

namespace App\Policies;

use App\Models\Student;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StudentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->checkPermissionAccess('students.index') ? Response::allow() : Response::deny('Bạn không có quyền truy cập');
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
        return $user->checkPermissionAccess('students.create') ? Response::allow() : Response::deny('Bạn không có quyền truy cập');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess('students.edit') ? Response::allow() : Response::deny('Bạn không có quyền truy cập');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess('students.destroy') ? Response::allow() : Response::deny('Bạn không có quyền truy cập');
    }

    public function quick_view_students(User $user)
    {
        return $user->checkPermissionAccess('quick_view_students') ? Response::allow() : Response::deny('Bạn không có quyền truy cập');
    }

    public function updateStatusStudents(User $user)
    {
        return $user->checkPermissionAccess('updateStatusStudents') ? Response::allow() : Response::deny('Bạn không có quyền truy cập');
    }
    
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Student $student)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Student $student)
    {
        //
    }
}
