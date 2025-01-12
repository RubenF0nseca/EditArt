<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected function getValidationRules(?Comment $comment = null): array
    {
        $id = $comment ? $comment->id : 'NULL';

        return [
            'content' => 'required|string|max:1000|unique:comments,content,' . $id,
        ];
    }

    protected array $messages = [
        'content.required' => 'O comentário é obrigatório.',
        'content.string' => 'O comentário deve ser um texto válido.',
        'content.max' => 'O comentário não pode exceder 1000 caracteres.',
        'content.unique' => 'Já existe um comentário idêntico registado.',
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('comment.index', ['comments' => Comment::paginate(12)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('comment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->getValidationRules(), $this->messages);
        try{
            $comment = new Comment($validated);
            $comment->save();
            return redirect(route('admin.comments.create'))->with('success',"Comentário gravado com sucesso! [#{$comment->id}]");
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => "Erro ao criar um comentário!"])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return view('comment.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        return view('comment.update', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $validated = $request->validate($this->getValidationRules($comment), $this->messages);
        try{
            $comment->update($validated);

            return redirect(route('admin.comments.create'))->with('success',"Comentário editado com sucesso! [#{$comment->id}]");
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => "Erro ao editar o comentário!"])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect(route('admin.comments.index'));
    }
}
