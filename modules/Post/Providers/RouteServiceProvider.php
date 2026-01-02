<?php

namespace Modules\Post\Providers;

use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends \Illuminate\Foundation\Support\Providers\RouteServiceProvider
{
    public function boot(){
        $this->routes(function (){
            Route::middleware('web')
                ->group(__DIR__ . '/../routes/web.php')
                ;
        });
    }
}
