<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function($user){
            return $user->role == 'admin';
        });

        Gate::define('isDriver', function($user){
            return $user->role == 'driver';
        });

        Gate::define('isClient', function($user){
            return $user->role == 'client';
        });

        Gate::define('isAccount', function($user){
            return $user->role == 'accounts';
        });

        Gate::define('isAdminOrAccounts', function($user){
            if($user->role == 'admin' || $user->role == 'accounts'){
                return true;
            }
        });

        Gate::define('isAdminOrDriver', function($user){
            if($user->role == 'admin' || $user->role == 'driver'){
                return true;
            }
        });

        Gate::define('isMyAccount', function($user, $AccountUser){
            return $user->id == $AccountUser->id;
        });



        //
        Passport::routes();
    }
}
