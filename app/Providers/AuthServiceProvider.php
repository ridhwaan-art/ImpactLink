<?php

namespace App\Providers;

use App\Models\Organization;
use App\Policies\OrganizationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Organization::class => OrganizationPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
