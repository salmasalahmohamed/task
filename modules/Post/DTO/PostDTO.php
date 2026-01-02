<?php

namespace Modules\Post\DTO;

class PostDTO
{
    public $title;
    public $content;
    public $status;
    public $publishedAt;
    public $categoryId;

    public function __construct(
        string $title,
        string $content,
        string $status,
        ?string $publishedAt,
        int $categoryId
    ) {
        $this->categoryId = $categoryId;
        $this->publishedAt = $publishedAt;
        $this->status = $status;
        $this->content = $content;
        $this->title = $title;
    }

    public static function fromRequest($request): self
    {
        return new self(
             $request->title,
            $request->content,
            $request->status,
          $request->published_at,
             $request->category_id
        );
    }
}
