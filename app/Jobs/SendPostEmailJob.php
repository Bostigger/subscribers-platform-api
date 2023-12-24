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
use Illuminate\Support\Facades\Log;
use Throwable;

class SendPostEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $subscriber;
    protected $post;

    /**
     * Create a new job instance.
     *
     * @param User $subscriber Subscriber to whom the email will be sent.
     * @param Post $post Post details to be sent.
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
        try {
            Mail::to($this->subscriber->email)->send(new PostPublished($this->subscriber, $this->post));
        } catch (Throwable $e) {
            // Log error details for troubleshooting
            Log::error("Failed to send email for Post ID {$this->post->id} to User ID {$this->subscriber->id}: {$e->getMessage()}");

        }
    }
}
