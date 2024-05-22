<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class QuestionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return $user->checkPermissionAccess('questions.index')
            ? Response::allow()
            : Response::deny('You are not authorized to view questions.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user)
    {
        return $user->checkPermissionAccess('questions.show')
            ? Response::allow()
            : Response::deny('You are not authorized to show questions.');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess('questions.create')
            ? Response::allow()
            : Response::deny('You are not authorized to create questions.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess('questions.edit')
            ? Response::allow()
            : Response::deny('You are not authorized to update questions.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess('questions.destroy')
            ? Response::allow()
            : Response::deny('You are not authorized to delete questions.');
    }

    public function quick_view_question(User $user)
    {
        return $user->checkPermissionAccess('quick_view_question')
            ? Response::allow()
            : Response::deny('You are not authorized to quick view questions.');
    }

    public function updateStatusQuestions(User $user)
    {
        return $user->checkPermissionAccess('updateStatusQuestions')
            ? Response::allow()
            : Response::deny('You are not authorized to update status questions.');
    }
    
    public function import(User $user)
    {
        return $user->checkPermissionAccess('questions.import')
            ? Response::allow()
            : Response::deny('You are not authorized to import questions.');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Question $question)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Question $question)
    {
        //
    }
}
