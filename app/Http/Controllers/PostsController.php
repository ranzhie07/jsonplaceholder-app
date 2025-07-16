<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::with('user');
        if ($request->has('userId')) {
            $query->where('user_id', $request->query('userId'));
        }

        $posts = $query->get()->map(function ($post) {
            return [
                'userId' => $post->user_id,
                'id' => $post->id,
                'title' => $post->title,
                'body' => $post->body,
            ];
        });

        return response()->json($posts);
    }


    public function show($id)
    {
        $post = Post::with('user')->findOrFail($id);

        return response()->json([
            'userId' => $post->user_id,
            'id' => $post->id,
            'title' => $post->title,
            'body' => $post->body,
        ]);
    }

    public function comments($id)
    {
        $post = \App\Models\Post::with('comments')->findOrFail($id);

        $comments = $post->comments->map(function ($comment) {
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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'userId' => ['required', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
        ]);

        $post = new Post();
        $post->user_id = $validated['userId'];
        $post->title = $validated['title'];
        $post->body = $validated['body'];

        if ($post->save()) {
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $post->id,
                    'userId' => $post->user_id,
                    'title' => $post->title,
                    'body' => $post->body,
                ]
            ], 201); // 201 Created
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create post.',
            ], 500); // 500 Internal Server Error
        }
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'userId' => ['required', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
        ]);
        
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => "Post with id {$id} not found."
            ], 404);
        }

        $post->user_id = $validated['userId'];
        $post->title = $validated['title'];
        $post->body = $validated['body'];
        $post->save();

        return response()->json([
            'id' => $post->id,
            'userId' => $post->user_id,
            'title' => $post->title,
            'body' => $post->body,
        ]);
    }

    public function patch(Request $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'message' => "Post with id {$id} not found."
            ], 404);
        }

        if ($request->has('title')) {
            $post->title = $request->input('title');
        }

        if ($request->has('body')) {
            $post->body = $request->input('body');
        }

        if ($request->has('userId')) {
            $userId = $request->input('userId');
            if (!\App\Models\User::find($userId)) {
                return response()->json([
                    'message' => "User with id {$userId} does not exist."
                ], 400);
            }
            $post->user_id = $userId;
        }

        $post->save();

        return response()->json([
            'id' => $post->id,
            'userId' => $post->user_id,
            'title' => $post->title,
            'body' => $post->body,
        ]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json(null, 200);
        }

        $post->delete();
        return response()->json(null, 200);
    }



}
