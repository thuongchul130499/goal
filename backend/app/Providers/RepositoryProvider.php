<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{

    protected static $repositories = [
        [
            'App\Repositories\Contracts\UserRepository',
            'App\Repositories\Eloquents\UserEloquentRepository',
        ],
        [
        'App\Repositories\Contracts\GoalRepository',
        'App\Repositories\Eloquents\GoalEloquentRepository',
    ],
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        foreach (static::$repositories as $repository) {
            $this->app->bind(
                $repository[0],
                $repository[1]
            );
        }
    }
}
