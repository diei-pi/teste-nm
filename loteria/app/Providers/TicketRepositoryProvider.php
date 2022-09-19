<?php

namespace App\Providers;

use App\Repositories\EloquentTicketRepository;
use App\Repositories\TicketRepository;
use Illuminate\Support\ServiceProvider;

class TicketRepositoryProvider extends ServiceProvider
{
    public array $bindings = [
        TicketRepository::class => EloquentTicketRepository::class,
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
        //
    }
}
