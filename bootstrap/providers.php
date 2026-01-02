<?php

use Modules\ActivityLog\Providers\ActivityLogServiceProvider;
use Modules\Post\Providers\PostServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    ActivityLogServiceProvider::class,
    PostServiceProvider::class
];
