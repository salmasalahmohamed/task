<?php

namespace Modules\Post\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\ActivityLog\Services\ActivityLogService;
use Modules\Post\Models\Post;

class PublishScheduledPostJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $post;
    public $adminId;

    public function __construct(Post $post, $adminId)
    {
        $this->post = $post;
        $this->adminId = $adminId;
    }
    public function handle()
    {
        if ($this->post->status === 'Scheduled') {
            $this->post->update(['status' => 'Published']);
            ActivityLogService::log('published', $this->post,$this->adminId);
        }
    }
}
