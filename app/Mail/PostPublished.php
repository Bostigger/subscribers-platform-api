<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostPublished extends Mailable
{
    use Queueable, SerializesModels;

    public $subscriber;
    public $post;

    /**
     * Create a new message instance.
     *
     * @param User $subscriber Subscriber receiving the email.
     * @param Post $post Post details to be included in the email.
     */
    public function __construct(User $subscriber, Post $post)
    {
        $this->subscriber = $subscriber;
        $this->post = $post;
    }

    /**
     * Build the email message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Post Published: ' . $this->post->title)
            ->view('emails.posts.published')
            ->with([
                'subscriberName' => $this->subscriber->name,
                'postTitle' => $this->post->title,
                'postDescription' => $this->post->description
            ]);
    }
}
