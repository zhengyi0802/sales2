<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Enums\UserRole;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];
    public static $permissions = [
       'ceo'               => [ UserRole::CEO ],
       'manager'           => [ UserRole::Manager ],
       'accounter'         => [ UserRole::Accounter ],
       'sales'             => [ UserRole::Sales ],
       'operator'          => [ UserRole::Operator ],
       'installer'         => [ UserRole::Installer],
       'reseller'          => [ UserRole::Reseller],
       'admin'             => [ UserRole::Administrator],
       'stocker'           => [ UserRole::Stocker],
       'CSR'               => [ UserRole::CSR],
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Roles based authorization
        Gate::before(
            function ($user, $ability) {
                if ($user->role === UserRole::Administrator || $user->role === UserRole::ShareHolder) {
                    return true;
                }
            }
        );

        Gate::define('sales122', function ($user) {
            return $user->sales->id === 122; // or any other condition
        });

        Gate::define('sales006', function ($user) {
            return $user->sales->id === 6; // or any other condition
        });

        Gate::define('sales005', function ($user) {
            return $user->sales->id === 5; // or any other condition
        });


        foreach (self::$permissions as $action => $roles) {
            Gate::define(
                $action,
                function ($user) use($action, $roles) {
                    if (in_array($user->role, $roles)) {
/*
                        if ($action == 'reseller-limit' || $action == 'distrobuter-limit') {
                            if ($user->role == UserRole::Reseller || $user->role == UserRole::Distrobuter) {
                                return ($user->member->share_status);
                            }
                        }
*/
                        return true;
                    }
                }
            );
        }
        //
    }
}
