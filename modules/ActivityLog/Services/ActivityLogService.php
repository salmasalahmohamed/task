<?php

namespace Modules\ActivityLog\Services;


use Modules\ActivityLog\Models\ActivityLog;
use Modules\Post\Models\Post;

class ActivityLogService
{
    public static function log(string $action, Post $post, $adminId = null)
    {

        $finalId = $adminId ?? auth()->id() ?? 1;

        ActivityLog::create([
            'action'   => $action,
            'post_id'  => $post->id,
            'admin_id' => $finalId,
        ]);
    }
}
