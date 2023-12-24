<?php

namespace App\Listeners;

use App\Events\PostCreated;
use App\Jobs\SendPostEmailJob;


class SendPostNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostCreated $event): void
    {
        $post = $event->post;
        $subscribers = $post->website->subscribers;

        foreach ($subscribers as $subscriber) {
            SendPostEmailJob::dispatch($subscriber, $post);
        }
        $post->email_sent = true;
        $post->save();
    }
}
