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
        [
            'App\Repositories\Contracts\PostRepository',
            'App\Repositories\Eloquents\PostEloquentRepository',
        ],
        [
            'App\Repositories\Contracts\NoteRepository',
            'App\Repositories\Eloquents\NoteEloquentRepository',
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
