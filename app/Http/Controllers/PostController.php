<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')
            ->latest()
            ->paginate(20);

        return view('posts.index', compact('posts'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'integer', 'min:1'],
        ]);

        $userId = $request->user_id;

        $posts = Post::with('user')
            ->where('user_id', $userId)
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('posts.index', compact('posts', 'userId'));
    }
}
