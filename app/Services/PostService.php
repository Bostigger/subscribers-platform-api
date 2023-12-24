<?php

namespace App\Services;

use App\Contracts\PostServiceInterface;
use App\Events\PostCreated;
use App\Models\Website;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostService implements PostServiceInterface
{
    protected $postModel;

    // Inject the Post model
    public function __construct(Post $postModel)
    {
        $this->postModel = $postModel;
    }

    /**
     * Create a post for a specific website.
     *
     * @param int $websiteId The ID of the website.
     * @param array $postData Data for the new post.
     * @return Post The newly created post.
     *
     * @throws ModelNotFoundException If the website is not found.
     */
    public function createPost($websiteId, array $postData)
    {
        $website = Website::find($websiteId);
        if (!$website) {
            throw new ModelNotFoundException("Website not found.");
        }

        $post = $this->postModel->create([
            'website_id' => $websiteId,
            'title' => $postData['title'],
            'description' => $postData['description'],
        ]);

        event(new PostCreated($post));

        return $post;
    }
}
