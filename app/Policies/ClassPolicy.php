<?php

namespace App\Policies;

use App\Models\Classs;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClassPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->checkPermissionAccess('class.index')
            ? Response::allow()
            : Response::deny('You are not authorized to view classs.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user)
    {
        return $user->checkPermissionAccess('class.show')
            ? Response::allow()
            : Response::deny('You are not authorized to show classs.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess('class.create')
            ? Response::allow()
            : Response::deny('You are not authorized to create classs.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess('class.edit')
            ? Response::allow()
            : Response::deny('You are not authorized to update classs.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess('class.destroy')
            ? Response::allow()
            : Response::deny('You are not authorized to delete classs.');
    }

    public function quick_view_class(User $user)
    {
        return $user->checkPermissionAccess('quick_view_class')
            ? Response::allow()
            : Response::deny('You are not authorized to quick view classs.');
    }

    public function updateStatusClasss(User $user)
    {
        return $user->checkPermissionAccess('updateStatusClasss')
            ? Response::allow()
            : Response::deny('You are not authorized to update status classs.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Classs $classs)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Classs $classs)
    {
        //
    }
}
