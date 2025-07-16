<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Album;
use App\Models\User;

class FetchAllAlbums extends Command
{
    protected $signature = 'fetch:albums';
    protected $description = 'Fetch albums from JSONPlaceholder and store in database';

    public function handle(): void
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/albums');
        $albums = $response->json();

        foreach ($albums as $album) {
            $user = User::find($album['userId']);

            if ($user) {
                Album::updateOrCreate(
                    ['id' => $album['id']],
                    [
                        'user_id' => $user->id,
                        'title' => $album['title'],
                    ]
                );
            }
        }

        $this->info('Albums fetched and stored successfully.');
    }
}
