<?php

namespace App\Providers;

use App\Services\PermissionGatePolicyAccess;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     * 
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $permissionGateAndPolicy = new PermissionGatePolicyAccess();
        $permissionGateAndPolicy->setGateAndPolicyAccess();
    }
}
