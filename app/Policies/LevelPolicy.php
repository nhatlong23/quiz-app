<?php

namespace App\Policies;

use App\Models\Level;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LevelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->checkPermissionAccess('levels.index')
            ? Response::allow()
            : Response::deny('You are not authorized to view levels.');
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
        return $user->checkPermissionAccess('levels.create')
            ? Response::allow()
            : Response::deny('You are not authorized to create levels.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess('levels.edit')
            ? Response::allow()
            : Response::deny('You are not authorized to update levels.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess('levels.destroy')
            ? Response::allow()
            : Response::deny('You are not authorized to delete levels.');
    }

    public function updateStatusLevels(User $user)
    {
        return $user->checkPermissionAccess('updateStatusLevels')
            ? Response::allow()
            : Response::deny('You are not authorized to update status levels.');
    }
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Level $level)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Level $level)
    {
        //
    }
}
