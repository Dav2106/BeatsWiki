<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\BeatRepositoryInterface;
use App\Interfaces\ProducerRepositoryInterface;
use App\Repositories\BeatRepository;
use App\Repositories\ProducerRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BeatRepositoryInterface::class,BeatRepository::class);
        $this->app->bind(ProducerRepositoryInterface::class,ProducerRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
