<?php

namespace App\Providers;

use App\Repository\Interfaces\{UserInterface, StateInterface, CityInterface, EstablishmentInterface, CBOInterface};
use App\Repository\{UserRepository, StateRepository, CityRepository, EstablishmentRepository, CBORepository};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(StateInterface::class, StateRepository::class);
        $this->app->bind(CityInterface::class, CityRepository::class);
        $this->app->bind(EstablishmentInterface::class, EstablishmentRepository::class);
        $this->app->bind(CBOInterface::class, CBORepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
