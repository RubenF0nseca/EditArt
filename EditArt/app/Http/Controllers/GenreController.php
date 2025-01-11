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
            'name' => 'required|string|max:50|unique:genres,name,' . $id,
        ];
    }
    protected array $messages = [
        'name.required' => 'O nome é obrigatório.',
        'name.string' => 'O nome deve ser um texto válido.',
        'name.max' => 'O nome não pode exceder 50 caracteres.',
        'name.unique' => 'Já existe um género literário com um nome idêntico registado.',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('genre.index', ['genres' => Genre::paginate(12)]);
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
            return redirect(route('admin.genres.create'))->with('success',"Género Literário gravado com sucesso! [#{$genre->id}]");
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => "Erro ao criar o género literário!"])->withInput();
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
        $validated = $request->validate($this->getValidationRules($genre), $this->messages);
        try{
            $genre->update($validated);

            return redirect(route('admin.genres.index'))->with('success',"Género Literário editado com sucesso! [#{$genre->id}]");
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => "Erro ao editar o género literário!"])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect(route('admin.genres.index'));
    }
}
