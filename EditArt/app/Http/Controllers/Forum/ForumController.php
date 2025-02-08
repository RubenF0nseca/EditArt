<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('forum.forum', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->load('user', 'comments.user');
        return view('forum.ForumPost', compact('post'));
    }
}
