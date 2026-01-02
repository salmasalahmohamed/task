<?php

namespace Modules\Post\Services;

use Modules\ActivityLog\Services\ActivityLogService;
use Modules\Post\DTO\PostDTO;
use Modules\Post\Jobs\PublishScheduledPostJob;
use Modules\Post\Models\Post;

class PostService
{
    public function list($filters)
    {
        return Post::query()
            ->when($filters['title'] ?? null,
                function ($q, $v) {
                    return $q->where('title', 'like', "%$v%");
                })
            ->when($filters['status'] ?? null,
                function ($q, $v) {
                    return $q->where('status', $v);
                })
            ->when($filters['category_id'] ?? null,
                function ($q, $v) {
                    return $q->where('category_id', $v);
                })
            ->with('category')
            ->latest()
            ->paginate(10);
    }
    public function create(PostDTO $dto): Post
    {
        $post = Post::create([
            'title' => $dto->title,
            'content' => $dto->content,
            'status' => $this->resolveStatus($dto),
            'published_at' => $dto->publishedAt,
            'category_id' => $dto->categoryId,
        ]);
        $adminId = auth()->id();
        if ($post->status === 'Scheduled') {
            PublishScheduledPostJob::dispatch($post,$adminId)
                ->delay($post->published_at)
                ->afterCommit();;
        }
        ActivityLogService::log('created', $post);

        return $post;
    }
    public function update(   PostDTO $dto,Post $post): Post
    {

        $post->update([
            'title'        => $dto->title,
            'content'      => $dto->content,
            'category_id'  => $dto->categoryId,
            'published_at' => $dto->publishedAt,
            'status'       => $this->resolveStatus($dto),
        ]);
        $post->refresh();
        ActivityLogService::log('updated', $post);

        return $post;
    }

    public function delete( $post): void
    {
        ActivityLogService::log('deleted', $post);

        $post->delete();
    }

    private function resolveStatus(PostDTO $dto): string
    {
        if ($dto->status === 'Published' &&
            $dto->publishedAt &&
            now()->lt($dto->publishedAt)) {
            return 'Scheduled';
        }

        return $dto->status;
    }
}
