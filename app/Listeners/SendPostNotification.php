<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Jobs\SendPostEmailJob;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class SendPostNotification implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param PostCreated $event
     */
    public function handle(PostCreated $event): void
    {
        try {
            $post = $event->post;
            $subscribers = $post->website->subscribers;

            foreach ($subscribers as $subscriber) {
                SendPostEmailJob::dispatch($subscriber, $post);
            }

            $post->email_sent = true;
            $post->save();
        } catch (\Exception $e) {
            // Log the exception for troubleshooting
            Log::error("Failed to dispatch email jobs for Post ID: {$event->post->id}, Error: {$e->getMessage()}");
        }
    }
}
