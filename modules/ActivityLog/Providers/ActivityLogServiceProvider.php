<?php

namespace Modules\ActivityLog\Providers;


class ActivityLogServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot(){
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations'
        );


    }

}
