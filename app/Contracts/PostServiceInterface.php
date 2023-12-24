<?php

namespace App\Contracts;

use App\Models\Post;

interface PostServiceInterface
{
    /**
     * Create a post for a specific website.
     *
     * @param int $websiteId
     * @param array $postData
     * @return Post
     */
    public function createPost($websiteId, array $postData);
}
