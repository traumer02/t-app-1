<?php

namespace App\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TAppServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * @return void
     */
    public function register(): void
    {
        $this->registerRepositories();
        $this->registerServices();
    }

    /**
     * @return string[]
     */
    public function provides(): array
    {
        return array_merge(
            array_keys(config('t-provider.repositories', [])),
            array_keys(config('t-provider.services', [])),
        );
    }

    /**
     * @return void
     */
    private function registerRepositories(): void
    {
        $repositories = config('t-provider.repositories');

        foreach ($repositories as $abstract => $concrete) {
            $this->app->bind(
                $abstract,
                function () use ($concrete) {
                    return new $concrete['repository'](new $concrete['model']);
                }
            );
        }
    }

    /**
     * @return void
     */
    private function registerServices(): void
    {
        $services = config('t-provider.services');

        if (!empty($services)) {
            foreach ($services as $contract => $service) {
                $this->app->bind($contract, $service);
            }
        }
    }
}
