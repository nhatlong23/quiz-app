<?php

namespace App\Policies;

use App\Models\Block;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BlockPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->checkPermissionAccess('blocks.index')
            ? Response::allow()
            : Response::deny('You are not authorized to view blocks.');
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
        return $user->checkPermissionAccess('blocks.create')
            ? Response::allow()
            : Response::deny('You are not authorized to create blocks.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess('blocks.edit')
            ? Response::allow()
            : Response::deny('You are not authorized to update blocks.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess('blocks.destroy')
            ? Response::allow()
            : Response::deny('You are not authorized to delete blocks.');
    }

    public function updateStatusBlocks(User $user)
    {
        return $user->checkPermissionAccess('updateStatusBlocks')
            ? Response::allow()
            : Response::deny('You are not authorized to update status blocks.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Block $block)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Block $block)
    {
        //
    }
}
