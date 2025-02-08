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
        $post->load('user');
        $comments = $post->comments()->with('user')->orderBy('created_at', 'asc')->paginate(10);
        return view('forum.ForumPost', compact('post', 'comments'));
    }

    /**
     * Armazena um novo tópico (post) do fórum.
     */
    public function store(Request $request)
    {
        $request->validate([
            'topic'   => 'required|string|max:25|unique:posts,title',
            'content' => 'required|string|max:5000',
        ]);

        $post = Post::create([
            'user_id' => auth()->id(),
            'title'   => $request->input('topic'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('client.forum.show', $post->id)
            ->with('success', 'Tópico criado com sucesso!');
    }

    /**
     * Armazena um comentário para um post.
     */
    public function storeComment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Comentário adicionado com sucesso!');
    }
}
