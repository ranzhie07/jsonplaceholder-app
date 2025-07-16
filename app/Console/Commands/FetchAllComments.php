<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Comment;
use App\Models\Post;

class FetchAllComments extends Command
{
    protected $signature = 'fetch:comments';
    protected $description = 'Fetch comments from JSONPlaceholder and store in database';

    public function handle(): void
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/comments');
        $comments = $response->json();

        foreach ($comments as $comment) {
            $post = Post::find($comment['postId']);

            if ($post) {
                Comment::updateOrCreate(
                    ['id' => $comment['id']],
                    [
                        'post_id' => $post->id,
                        'name' => $comment['name'],
                        'email' => $comment['email'],
                        'body' => $comment['body'],
                    ]
                );
            }
        }

        $this->info('Comments fetched and stored successfully.');
    }
}
