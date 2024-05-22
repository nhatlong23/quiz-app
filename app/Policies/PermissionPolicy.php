<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PermissionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->checkPermissionAccess('permissions.index')
            ? Response::allow()
            : Response::deny('You are not authorized to view permissions.');
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
        return $user->checkPermissionAccess('permissions.create')
            ? Response::allow()
            : Response::deny('You are not authorized to create permissions.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess('permissions.edit')
            ? Response::allow()
            : Response::deny('You are not authorized to update permissions.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess('permissions.destroy')
            ? Response::allow()
            : Response::deny('You are not authorized to delete permissions.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Permission $permission)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Permission $permission)
    {
        //
    }
}
