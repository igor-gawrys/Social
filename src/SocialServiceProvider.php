<?php

namespace Igorgawrys\Social;

use Auth;
use Hautelook\Phpass\PasswordHash;
use Illuminate\Support\ServiceProvider;
use Igorgawrys\Social\Auth\EloquentSocialUserProvider;
use Igorgawrys\Social\Guard\SocialGuard;
use Igorgawrys\Social\Hashing\SocialHasher;

class SocialServiceProvider extends ServiceProvider
{
     /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/social.php' => config_path('social.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../models/User.php' => app_path('User.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../migrations/2014_10_12_000000_create_users_table.php' => migration_path('2014_10_12_000000_create_users_table.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/social.php', 'social');

        Auth::extend('social', function ($app) {
            return new SocialGuard(
                new EloquentSocialUserProvider($app['social'], $config['model'])
            );
        });

        $this->app->singleton('social', function ($app) {
            $iteration_count = $app['config']->get('social.hash.iteration_count');
            $portable_hashes = $app['config']->get('social.hash.portable_hashes');
            $hasher = new PasswordHash($iteration_count, $portable_hashes);
            return new SocialHasher($hasher);
        });

        Auth::provider('eloquent.social', function ($app, array $config) {
            return new EloquentSocialUserProvider($app['social'], $config['model']);
        });
    }

       /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return ['social'];
    }
}
