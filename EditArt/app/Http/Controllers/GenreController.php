<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    protected function getValidationRules(?Genre $genre = null): array
    {
        $id = $genre ? $genre->id : 'NULL';

        return [
            'name' => 'required|string|max:50|unique:genre,name,' . $id,
        ];
    }

    protected array $messages = [
        'genre.required' => 'O nome do género é obrigatório.',
        'genre.string' => 'O nome do género ser um texto válido.',
        'genre.max' => 'O nome do género não pode exceder 50 caracteres.',
        'genre.unique' => 'Já existe um género literário com este nome.',
    ];


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('genre.index', ['genres' => Genre::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('genre.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->getValidationRules(), $this->messages);
        try{
            $genre = new Genre($validated);
            $genre->save();
            return redirect(route('genre.create'))->with('success',"Género Literário gravado com sucesso! [#{$genre->id}]");
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => "Erro ao criar um Género Literário!"])->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        return view('genre.update', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        $validated = $request->validate($this->getValidationRules(), $this->messages);
        try{
            $genre->update($validated);

            return redirect(route('genre.index', $genre->id))->with('success',"Género Literário alterado com sucesso! [#{$genre->id}]");
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => "Erro ao alterar o Género Literário!"])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect(route('genre.index'));
    }
}
