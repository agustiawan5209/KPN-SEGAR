<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('Pengurus', function(User $user){
            return $user->roles->id == "1";
        });
        Gate::define('Anggota', function(User $user){
            return $user->anggota != null;
        });
        Gate::define('Pengguna', function(User $user){
            return $user->roles->id == "2";
        });
        Gate::define('Bendahara', function(User $user){
            return $user->roles->id == "3";
        });

        //
    }
}
