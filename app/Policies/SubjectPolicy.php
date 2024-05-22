<?php

namespace App\Policies;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SubjectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->checkPermissionAccess('subjects.index') ? Response::allow() : Response::deny('Bạn không có quyền truy cập');

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
        return $user->checkPermissionAccess('subjects.create') ? Response::allow() : Response::deny('Bạn không có quyền truy cập');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess('subjects.edit') ? Response::allow() : Response::deny('Bạn không có quyền truy cập');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess('subjects.destroy') ? Response::allow() : Response::deny('Bạn không có quyền truy cập');
    }

    public function updateStatusSubjects(User $user)
    {
        return $user->checkPermissionAccess('updateStatusSubjects') ? Response::allow() : Response::deny('Bạn không có quyền truy cập');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Subject $subject)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Subject $subject)
    {
        //
    }
}
