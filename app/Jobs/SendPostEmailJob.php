<?php

namespace App\Jobs;

use App\Mail\PostPublished;
use App\Models\Post;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPostEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $subscriber;
    protected $post;

    /**
     * Create a new job instance.
     *
     * @param User $subscriber
     * @param Post $post
     */
    public function __construct(User $subscriber, Post $post)
    {
        $this->subscriber = $subscriber;
        $this->post = $post;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $subscriber = $this->subscriber;
        $post = $this->post;

        Mail::to($subscriber->email)->send(new PostPublished($subscriber, $post));
    }
}
