<?php

namespace azhar\helloworld;

use Illuminate\Support\ServiceProvider;

class CalculatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        // initiate class and binding class into service container.
    }

    public function boot()
    {
        // called after all services are registered.
    }
}