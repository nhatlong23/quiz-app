<?php

namespace App\Services;

use Illuminate\Support\Facades\Gate;
use App\Policies\UserPolicy;
use App\Policies\SubjectPolicy;
use App\Policies\StudentPolicy;
use App\Policies\ClassPolicy;
use App\Policies\QuestionPolicy;
use App\Policies\BlockPolicy;
use App\Policies\LevelPolicy;
use App\Policies\ExamPolicy;
use App\Policies\BlogPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\ResultPolicy;

class PermissionGatePolicyAccess
{
    public function setGateAndPolicyAccess()
    {
        $this->defineGateUsers();
        $this->defineGateRoles();
        $this->defineGateSubjects();
        $this->defineGateStudents();
        $this->defineGateClass();
        $this->defineGateQuestions();
        $this->defineGateBlocks();
        $this->defineGateLevels();
        $this->defineGateExams();
        $this->defineGateBlogs();
        $this->defineGatePermissions();
        $this->defineGateResults();
    }
    
    public function defineGateSubjects()
    {
        Gate::define('subjects.viewAny', [SubjectPolicy::class, 'viewAny']);
        Gate::define('subjects.create', [SubjectPolicy::class, 'create']);
        Gate::define('subjects.edit', [SubjectPolicy::class, 'update']);
        Gate::define('subjects.destroy', [SubjectPolicy::class, 'delete']);
        Gate::define('updateStatusSubjects', [SubjectPolicy::class, 'updateStatusSubjects']);
    }

    public function defineGateStudents()
    {
        Gate::define('students.viewAny', [StudentPolicy::class, 'viewAny']);
        Gate::define('students.create', [StudentPolicy::class, 'create']);
        Gate::define('students.edit', [StudentPolicy::class, 'update']);
        Gate::define('students.destroy', [StudentPolicy::class, 'delete']);
        Gate::define('quick_view_students', [StudentPolicy::class, 'quick_view_students']);
        Gate::define('updateStatusStudents', [StudentPolicy::class, 'updateStatusStudents']);
    }

    public function defineGateClass()
    {
        Gate::define('class.viewAny', [ClassPolicy::class, 'viewAny']);
        Gate::define('class.create', [ClassPolicy::class, 'create']);
        Gate::define('class.view', [ClassPolicy::class, 'view']);
        Gate::define('class.edit', [ClassPolicy::class, 'update']);
        Gate::define('class.destroy', [ClassPolicy::class, 'delete']);
        Gate::define('quick_view_class', [ClassPolicy::class, 'quick_view_class']);
        Gate::define('updateStatusClasss', [ClassPolicy::class, 'updateStatusClasss']);
    }

    public function defineGateQuestions()
    {
        Gate::define('questions.viewAny', [QuestionPolicy::class, 'viewAny']);
        Gate::define('questions.create', [QuestionPolicy::class, 'create']);
        Gate::define('questions.view', [QuestionPolicy::class, 'view']);
        Gate::define('questions.edit', [QuestionPolicy::class, 'update']);
        Gate::define('questions.destroy', [QuestionPolicy::class, 'delete']);
        Gate::define('questions.import', [QuestionPolicy::class, 'import']);
        Gate::define('quick_view_question', [QuestionPolicy::class, 'quick_view_question']);
        Gate::define('updateStatusQuestions', [QuestionPolicy::class, 'updateStatusQuestions']);
    }

    public function defineGateBlocks()
    {
        Gate::define('blocks.viewAny', [BlockPolicy::class, 'viewAny']);
        Gate::define('blocks.create', [BlockPolicy::class, 'create']);
        Gate::define('blocks.edit', [BlockPolicy::class, 'update']);
        Gate::define('blocks.destroy', [BlockPolicy::class, 'delete']);
        Gate::define('updateStatusBlocks', [BlockPolicy::class, 'updateStatusBlocks']);
    }

    public function defineGateLevels()
    {
        Gate::define('levels.viewAny', [LevelPolicy::class, 'viewAny']);
        Gate::define('levels.create', [LevelPolicy::class, 'create']);
        Gate::define('levels.edit', [LevelPolicy::class, 'update']);
        Gate::define('levels.destroy', [LevelPolicy::class, 'delete']);
        Gate::define('updateStatusLevels', [LevelPolicy::class, 'updateStatusLevels']);
    }

    public function defineGateExams()
    {
        Gate::define('exams.viewAny', [ExamPolicy::class, 'viewAny']);
        Gate::define('exams.create', [ExamPolicy::class, 'create']);
        Gate::define('exams.edit', [ExamPolicy::class, 'update']);
        Gate::define('exams.destroy', [ExamPolicy::class, 'delete']);

        Gate::define('quick_view_exam', [ExamPolicy::class, 'quick_view_exam']);
        Gate::define('exams_request', [ExamPolicy::class, 'exams_request']);
        Gate::define('addExamToClass', [ExamPolicy::class, 'addExamToClass']);
        Gate::define('updateStatusExams', [ExamPolicy::class, 'updateStatusExams']);
        Gate::define('deleteQuestionFromExam', [ExamPolicy::class, 'deleteQuestionFromExam']);
    }

    public function defineGateBlogs()
    {
        Gate::define('blogs.viewAny', [BlogPolicy::class, 'viewAny']);
        Gate::define('blogs.create', [BlogPolicy::class, 'create']);
        Gate::define('blogs.view', [BlogPolicy::class, 'view']);
        Gate::define('blogs.edit', [BlogPolicy::class, 'update']);
        Gate::define('blogs.destroy', [BlogPolicy::class, 'delete']);
        Gate::define('updateStatusBlogs', [BlogPolicy::class, 'updateStatusBlogs']);
        Gate::define('updateStatusComments', [BlogPolicy::class, 'updateStatusComments']);
        Gate::define('review_comment', [BlogPolicy::class, 'review_comment']);
        Gate::define('reply_comment', [BlogPolicy::class, 'reply_comment']);
    }

    public function defineGatePermissions()
    {
        Gate::define('permissions.viewAny', [PermissionPolicy::class, 'viewAny']);
        Gate::define('permissions.create', [PermissionPolicy::class, 'create']);
        Gate::define('permissions.edit', [PermissionPolicy::class, 'update']);
        Gate::define('permissions.destroy', [PermissionPolicy::class, 'delete']);
    }

    public function defineGateUsers()
    {
        Gate::define('users.viewAny', [UserPolicy::class, 'viewAny']);
        Gate::define('users.create', [UserPolicy::class, 'create']);
        Gate::define('users.edit', [UserPolicy::class, 'update']);
        Gate::define('users.destroy', [UserPolicy::class, 'delete']);
    }

    public function defineGateRoles()
    {
        Gate::define('roles.viewAny', [UserPolicy::class, 'viewAny']);
        Gate::define('roles.create', [UserPolicy::class, 'create']);
        Gate::define('roles.edit', [UserPolicy::class, 'update']);
        Gate::define('roles.destroy', [UserPolicy::class, 'delete']);
    }

    public function defineGateResults()
    {
        Gate::define('result.viewAny', [ResultPolicy::class, 'viewAny']);
        Gate::define('result.view', [ResultPolicy::class, 'view']);
    }
}
