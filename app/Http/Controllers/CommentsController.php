<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index(Request $request)
    {
        $comments = Comment::when($request->postId, function ($query, $postId) {
            return $query->where('post_id', $postId);
        })->get()->map(function ($comment) {
            return [
                'postId' => $comment->post_id,
                'id' => $comment->id,
                'name' => $comment->name,
                'email' => $comment->email,
                'body' => $comment->body,
            ];
        });

        return response()->json($comments);
    }

    public function show($id)
    {
        $comment = Comment::with('post')->findOrFail($id);

        return response()->json([
            'postId' => $comment->post_id,
            'id' => $comment->id,
            'name' => $comment->name,
            'email' => $comment->email,
            'body' => $comment->body,
        ]);
    }
}
