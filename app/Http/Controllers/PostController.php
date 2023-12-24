<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Services\PostService;
use Exception;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @throws Exception
     */
    public function store(StorePostRequest $request, $websiteId)
    {
        $post = $this->postService->createPost($websiteId, $request->validated());
        return response()->json($post, 201);
    }


}
