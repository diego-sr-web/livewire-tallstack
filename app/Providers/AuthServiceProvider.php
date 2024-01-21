<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Collaborators\Collaborator;
use App\Models\Owners\Owner;
use App\Models\Users\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::before(function (User $user, $ability) {
            switch ($ability) {
                case Owner::class:
                    if ($user->profile->rel_type == Owner::class) {
                        return true;
                    }

                    return false;

                    break;
                case 'admin':
                    if ($user->is_admin) {
                        return true;
                    }

                    if ($user->profile->role->is_admin) {
                        return true;
                    }

                    return false;

                    break;
                case 'panel':
                    $access = (bool) $user->profile->role->permissions->where('slug', $ability)->count();

                    if (! $access) {
                        $access = $user->is_admin;
                    }

                    if (! $access) {
                        $access = $user->profile->rel_type == Collaborator::class;
                    }

                    return $access;
                    break;
                default:
                    $access = (bool) $user->profile->role->permissions->where('slug', $ability)->count();

                    return $access;
                    break;
            }
        });
    }
}
