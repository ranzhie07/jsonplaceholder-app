<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Post;
use App\Models\User;

class FetchAllPosts extends Command
{
    protected $signature = 'fetch:posts';
    protected $description = 'Fetch posts from JSONPlaceholder and store in database';

    public function handle(): void
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts');
        $posts = $response->json();

        foreach ($posts as $post) {
            $user = User::find($post['userId']); // Ensure user exists
            
            if ($user) {
                Post::updateOrCreate(
                    ['id' => $post['id']], // Assuming you want to preserve JSONPlaceholder post IDs
                    [
                        'user_id' => $user->id,
                        'title' => $post['title'],
                        'body' => $post['body'],
                    ]
                );
            }
        }

        $this->info('Posts fetched and stored successfully.');
    }
}
