<?php

namespace App\Http\Controllers;

use App\Models\Album;

class AlbumsController extends Controller
{
    public function index()
    {
        $albums = Album::with('user')->get()->map(function ($album) {
            return [
                'userId' => $album->user_id,
                'id' => $album->id,
                'title' => $album->title,
            ];
        });

        return response()->json($albums);
    }

    public function show($id)
    {
        $album = Album::with('user')->findOrFail($id);

        return response()->json([
            'userId' => $album->user_id,
            'id' => $album->id,
            'title' => $album->title,
        ]);
    }
}
