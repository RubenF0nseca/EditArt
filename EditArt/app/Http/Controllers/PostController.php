<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected function getValidationRules(?Post $post = null): array
    {
        $id = $post ? $post->id : 'NULL';

        return [
            'title' => 'required|string|max:25|unique:posts,title,' . $id,
            'content' => 'required|string|max:5000',
        ];
    }

    protected array $messages = [
        'title.required' => 'O título é obrigatório.',
        'title.string' => 'O título deve ser um texto válido.',
        'title.max' => 'O título não pode exceder 25 caracteres.',
        'title.unique' => 'Já existe um tópico com este título.',

        'content.required' => 'O conteúdo é obrigatório.',
        'content.string' => 'O conteúdo deve ser um texto válido.',
        'content.max' => 'O conteúdo não pode exceder 5000 caracteres.',
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('is_support', false)
        ->where('is_resolved', false)
        ->orderBy('created_at', 'desc')
        ->paginate(12);

        return view('post.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->getValidationRules(), $this->messages);
        try{
            $post = new Post($validated);
            $post->save();
            return redirect(route('admin.posts.create'))->with('success',"Tópico gravado com sucesso! [#{$post->id}]");
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => "Erro ao criar o tópico!"])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.update', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Se for apenas para atualizar o estado is_resolved
        if ($request->has('is_resolved')) {
            $post->is_resolved = $request->is_resolved;
            $post->save();

            return redirect()->back()->with('success', "Estado da publicação atualizado! [#{$post->id}]");
        }

        $validated = $request->validate($this->getValidationRules($post), $this->messages);
        try{
            $post->update($validated);

            return redirect(route('admin.posts.show', $post->id))->with('success',"Tópico alterado com sucesso! [#{$post->id}]");
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => "Erro ao alterar o tópico!"])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect(route('admin.posts.index'));
    }
}
