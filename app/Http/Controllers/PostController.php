<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\NewPostNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'website_id' => 'required|exists:websites,id',
            'created_at' => 'nullable|date',
        ]);

        $post = Post::create($validatedData);

        return response()->json([
            'message' => 'Post created and subscribers notified.',
            'post' => $post,
        ], 201);
    }

    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->has('website_id')) {
            $query->where('website_id', $request->get('website_id'));
        }

        $posts = $query->get();

        return response()->json($posts, 200);
    }
}

