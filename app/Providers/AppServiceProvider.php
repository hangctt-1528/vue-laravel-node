<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepository;

use App\Repositories\UserRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    protected $services = [
        UserRepositoryInterface::class => UserRepository::class,
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
