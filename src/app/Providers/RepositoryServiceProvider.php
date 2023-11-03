<?php

namespace App\Providers;

use Domain\Repositories\TodoRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Infrastructure\EloquentRepositories\TodoRepository;
use Infrastructure\InMemoryRepositories\TodoRepositoryMock;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(TodoRepositoryInterface::class, TodoRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
