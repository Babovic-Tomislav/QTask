<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Http\Client\QClient;
use App\Models\User;
use App\Services\CustomGuard;
use App\Services\UserFactory;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Auth::provider('custom', function($app, array $config) {
            $userFactory = $this->app->make(UserFactory::class);
            $client = $this->app->make(QClient::class);
            return new CustomUserProvider($userFactory, $client);
        });

        Auth::extend('custom', function ($app, $name, array $config) {
            return new CustomGuard($config['driver'], Auth::createUserProvider($config['provider']), $this->app['events']);
        });
    }

    public function register()
    {
        $this->app->bind('App\Services\UserFactory', function()
        {
            return new UserFactory(User::class);
        });
    }
}
