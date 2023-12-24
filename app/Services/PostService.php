<?php

namespace App\Services;

use App\Contracts\PostServiceInterface;
use App\Events\PostCreated;
use App\Models\Post;
use App\Models\Website;

class PostService implements PostServiceInterface
{
    public function createPost($websiteId, array $postData)
    {
     //validating the website
    $website = Website::find($websiteId);
    if (!$website) {
        throw new \Exception("Website not found.");
    }

    // if website is found Create the post
    $post = new Post();
    $post->website_id = $websiteId;
    $post->title = $postData['title'];
    $post->description = $postData['description'];
    $post->save();

    // Trigger an event after post creation
    event(new PostCreated($post));

    return $post;
   }
}
