<?php

namespace App\Providers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @param ResponseFactory $factory
     * @return void
     */
    public function boot(ResponseFactory $factory)
    {
        $factory->macro('api', function ($data) use ($factory) {
            $customFormat = [
                'success' => true,
                'data' => $data
            ];
            return $factory->make($customFormat);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
