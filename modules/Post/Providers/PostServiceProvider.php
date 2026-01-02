<?php

namespace Modules\Post\Providers;

use Modules\Post\Providers\RouteServiceProvider;

class PostServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot(){
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations'
        );
        $this->mergeConfigFrom(__DIR__.'/../config.php','Post');
//        $this->app->register(RouteServiceProvider::class);

$this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadViewsFrom(
            __DIR__ . '/../Views',
            'post'
        );

    }

}
