<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Cria a query base conforme o papel do usuário
        if (auth()->user()->hasRole('admin')) {
            // Administradores veem todos os posts
            $query = Post::query();
        } else {
            // Usuários comuns veem os posts que não são de suporte
            // ou os posts de suporte que foram criados por eles
            $query = Post::where(function ($query) {
                $query->where('is_support', false)
                    ->orWhere(function ($q) {
                        $q->where('is_support', true)
                            ->where('user_id', auth()->id());
                    });
            });
        }

        // Se houver parâmetro de busca, filtra pelo título
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        // Ordena e pagina os resultados
        $posts = $query->orderBy('created_at', 'desc')->paginate(12);

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
            'is_support' => $request->input('is_support'),
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
