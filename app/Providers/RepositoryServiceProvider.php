<?php

namespace App\Providers;

use App\Contracts\FormRepositoryInterface;
use App\Contracts\MTypeFormRepositoryInterface;
use App\Contracts\UserRepositoryInterface;
use App\Repositories\FormRepository;
use App\Repositories\MTypeFormRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $class) {
            $this->app->singleton($interface, $class);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    protected $repositories = [
        UserRepositoryInterface::class => UserRepository::class,
        FormRepositoryInterface::class => FormRepository::class,
        MTypeFormRepositoryInterface::class => MTypeFormRepository::class,
    ];
}
