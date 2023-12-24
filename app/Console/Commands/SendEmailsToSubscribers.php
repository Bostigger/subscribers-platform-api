<?php

namespace App\Console\Commands;


use App\Jobs\SendPostEmailJob;
use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SendEmailsToSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails-to-subscribers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails to subscribers for new posts';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $posts = Post::where('email_sent', false)->get();

        foreach ($posts as $post) {
            DB::transaction(function () use ($post) {
                foreach ($post->website->subscribers as $subscriber) {
                    SendPostEmailJob::dispatch($subscriber, $post);
                }

                $post->email_sent = true;
                $post->save();
            });
        }

        $this->info('Emails have been sent.');
    }
}
