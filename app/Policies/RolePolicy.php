<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->checkPermissionAccess('roles.index') ? Response::allow() : Response::deny('Bạn không có quyền truy cập');

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
        return $user->checkPermissionAccess('roles.create') ? Response::allow() : Response::deny('Bạn không có quyền truy cập');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess('roles.edit') ? Response::allow() : Response::deny('Bạn không có quyền truy cập');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess('roles.destroy') ? Response::allow() : Response::deny('Bạn không có quyền truy cập');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role)
    {
        //
    }
}
