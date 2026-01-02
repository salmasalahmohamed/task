<?php

namespace Modules\Post\controllers;

use Illuminate\Http\Request;
use Modules\ActivityLog\Services\ActivityLogService;
use Modules\Post\DTO\PostDTO;
use Modules\Post\Models\Category;
use Modules\Post\Models\Post;
use Modules\Post\Requests\StorePostRequest;
use Modules\Post\Requests\UpdatePostRequest;
use Modules\Post\Services\PostService;

class PostController extends \App\Http\Controllers\Controller
{
    public $postservice;
    public function __construct(PostService $postService)
    {
        $this->postservice=$postService;
    }
    public function index(Request $request)
    {
        return view('post::index', [
            'posts' => $this->postservice->list($request->all()),
                    'categories' => Category::select('id', 'name')->get(),

        ]);
    }
    public function store(StorePostRequest $request){
        $this->postservice->create(PostDTO::fromRequest($request));
        return redirect()->back()->with('success', 'Post created');




    }
    public function update(

        UpdatePostRequest $request,
         $post

    ) {
        $post=Post::where('id',$post)->first();
        $this->postservice->update( PostDTO::fromRequest($request),$post);

        return redirect()->back()->with('success', 'Post updated');
    }
    public function destroy( $post)
    {
        $post=Post::where('id',$post)->first();
        $this->postservice->delete($post);
        return redirect()->back()->with('success', 'Post deleted');
    }
}
