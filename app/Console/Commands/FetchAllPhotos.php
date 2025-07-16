<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Photo;
use App\Models\Album;

class FetchAllPhotos extends Command
{
    protected $signature = 'fetch:photos';
    protected $description = 'Fetch photos from JSONPlaceholder and store in database';

    public function handle(): void
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/photos');
        $photos = $response->json();

        foreach ($photos as $photo) {
            $album = Album::find($photo['albumId']);

            if ($album) {
                Photo::updateOrCreate(
                    ['id' => $photo['id']],
                    [
                        'album_id' => $album->id,
                        'title' => $photo['title'],
                        'url' => $photo['url'],
                        'thumbnail_url' => $photo['thumbnailUrl'],
                    ]
                );
            }
        }

        $this->info('Photos fetched and stored successfully.');
    }
}
