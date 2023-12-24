<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * Store a newly created post in storage.
     *
     * @param StorePostRequest $request
     * @param int $websiteId
     * @return JsonResponse
     *
     * @throws ModelNotFoundException If the website is not found.
     */
    public function store(StorePostRequest $request, $websiteId): JsonResponse
    {
        try {
            $post = $this->postService->createPost($websiteId, $request->validated());
            return response()->json($post, ResponseAlias::HTTP_CREATED);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => $e->getMessage()], ResponseAlias::HTTP_NOT_FOUND);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
