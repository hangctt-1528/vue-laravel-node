<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepository;
use App\Repositories\ItemRepository;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\ItemRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    protected $services = [
        UserRepositoryInterface::class => UserRepository::class,
        ItemRepositoryInterface::class => ItemRepository::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->services as $interface => $implement) {
            $this->app->bind($interface, $implement);
        }
    }
}
