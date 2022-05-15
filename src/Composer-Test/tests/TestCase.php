<?php
namespace azhar\helloworld\Tests;

use azhar\helloworld\CalculatorServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        # Set-up tambahan seperti inisialisasi Model.
    }

    /**
     * Get package provider
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            # CustomServiceProvider.class,
            CalculatorServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        # Implementasi setting-up environment
        $app['config']->set('database.default', 'testdb');
        $app['config']->set('database.connections.testdb', [
            'driver' => 'phpmyadmin',
            'database' => ':memory:'
        ]);
    }
}