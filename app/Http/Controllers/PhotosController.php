<?php

namespace App\Http\Controllers;

use App\Models\Photo;

class PhotosController extends Controller
{
    public function index()
    {
        $photos = Photo::with('album')->get()->map(function ($photo) {
            return [
                'albumId' => $photo->album_id,
                'id' => $photo->id,
                'title' => $photo->title,
                'url' => $photo->url,
                'thumbnailUrl' => $photo->thumbnail_url,
            ];
        });

        return response()->json($photos);
    }

    public function show($id)
    {
        $photo = Photo::with('album')->findOrFail($id);

        return response()->json([
            'albumId' => $photo->album_id,
            'id' => $photo->id,
            'title' => $photo->title,
            'url' => $photo->url,
            'thumbnailUrl' => $photo->thumbnail_url,
        ]);
    }
    
}
