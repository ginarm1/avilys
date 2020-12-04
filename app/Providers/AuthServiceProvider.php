<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('administrators-only',function ($user){
            if($user -> fk_role == 3){
                return true;
            }
            return false;
        });
        Gate::define('managers-only',function ($user){
            if($user -> fk_role == 2){
                return true;
            }
            return false;
        });
        Gate::define('not-guests',function ($user){
            if($user -> fk_role > 0 ){
                return true;
            }
            return false;
        });
        Gate::define('not-clients',function ($user){
            if($user -> fk_role > 1 ){
                return true;
            }
            return false;
        });


    }
}
