<?php

namespace Damianchojnacki\AccessToken;

use Illuminate\Support\ServiceProvider;

class AccessTokenServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__.'/access.php' => config_path('access.php'),
        ]);

        $this->mergeConfigFrom(
            __DIR__.'/access.php', 'access'
        );

        if ($this->app->runningInConsole()) {
            $this->commands([
                AccessTokenGenerate::class,
            ]);
        }
    }
}
