<?php

namespace Modules\ActivityLog\Services;


use Modules\ActivityLog\Models\ActivityLog;
use Modules\Post\Models\Post;

class ActivityLogService
{
    public static function log(string $action, Post $post)
    {
        ActivityLog::create([
            'action' => $action,
            'post_id' => $post->id,
            'admin_id' => auth('admin')->id()
        ]);
    }
}
