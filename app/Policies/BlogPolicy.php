<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BlogPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->checkPermissionAccess('blogs.index')
            ? Response::allow()
            : Response::deny('You are not authorized to view blogs.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user)
    {
        return $user->checkPermissionAccess('blogs.show')
            ? Response::allow()
            : Response::deny('You are not authorized to show blogs.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess('blogs.create')
            ? Response::allow()
            : Response::deny('You are not authorized to create blogs.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, $id)
    {
        $blogs = Blog::find($id);

        if ($user->checkPermissionAccess('blogs.edit') && $user->id === $blogs->users_id) {
            return Response::allow();
        } else {
            return Response::deny('You are not authorized to edit blogs.');
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess('blogs.destroy')
            ? Response::allow()
            : Response::deny('You are not authorized to delete blogs.');
    }

    public function updateStatusBlogs(User $user)
    {
        return $user->checkPermissionAccess('updateStatusBlogs')
            ? Response::allow()
            : Response::deny('You are not authorized to update status blogs.');
    }
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Blog $blog)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Blog $blog)
    {
        //
    }
}
