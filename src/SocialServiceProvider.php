<?php

namespace Igorgawrys\Social;

use Illuminate\Support\ServiceProvider;
use Igorgawrys\Social\Auth\EloquentSocialUserProvider;
use Igorgawrys\Social\Guard\SocialGuard;
use Igorgawrys\Social\Hashing\SocialHasher;

class SocialServiceProvider extends ServiceProvider
{
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
        $this->app->singleton('social-auth', function ($app) {
            $iteration_count = $app['config']->get('social-auth.hash.iteration_count');
            $portable_hashes = $app['config']->get('social-auth.hash.portable_hashes');
            $hasher = new PasswordHash($iteration_count, $portable_hashes);
            return new SocialHasher($hasher);
        });
        Auth::provider('eloquent.social', function ($app, array $config) {
            return new EloquentSocialUserProvider($app['social'], $config['model']);
        });
    }

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
    }
}
