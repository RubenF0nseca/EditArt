<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected function getValidationRules(?Author $author = null): array
    {
        $id = $author ? $author->id : 'NULL';

        return [
            'name' => 'required|string|max:255',
            'biography' => 'required|string|max:1000',
            'birthdate' => 'required|date|before:today',
            'profilePicture' => 'nullable|mimes:jpg,png|max:2048',
        ];
    }

    protected array $messages = [
        'name.required' => 'O nome é obrigatório.',
        'name.string' => 'O nome deve ser um texto válido.',
        'name.max' => 'O nome não pode exceder 255 caracteres.',

        'biography.required' => 'A biografia é obrigatória.',
        'biography.string' => 'A biografia deve ser um texto válido.',
        'biography.max' => 'A biografia não pode exceder 1000 caracteres.',

        'birthdate.required' => 'A data de nascimento é obrigatória.',
        'birthdate.date' => 'A data de nascimento deve ser uma data válida.',
        'birthdate.before' => 'A data de nascimento deve ser anterior a hoje.',

        'profilePicture.mimes' => 'A imagem deve estar no formato JPG ou PNG.',
        'profilePicture.max' => 'A foto do autor não pode exceder 2 MB.',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('author.index', ['authors' => Author::paginate(12)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->getValidationRules(), $this->messages);

        try {
            $photo = $request->file('profilePicture');
            if ($request->hasFile('profilePicture')) {


                $extension = pathinfo($photo->getClientOriginalName(), PATHINFO_EXTENSION);

                $filename = preg_replace('/\s+/', '', strtolower($validated['name'])) . '_' . time() . '.' . $extension;

                $url = $photo->storeAs('authors', $filename, 'public');
                $validated['profilePicture'] = $url;
            }

            $author = new Author($validated);
            $author->save();

            return redirect(route('admin.authors.create'))->with('success', "Autor criado com sucesso! [#{$author->id}]");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => "Erro ao criar o autor!"])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        return view('author.show', compact('author'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        return view('author.update', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $validated = $request->validate($this->getValidationRules($author), $this->messages);

        try {
            $photo = $request->file('profilePicture');
            if ($request->hasFile('profilePicture')) {

                $extension = pathinfo($photo->getClientOriginalName(), PATHINFO_EXTENSION);
                $filename = preg_replace('/\s+/', '', strtolower($validated['name'])) . '_' . time() . '.' . $extension;

                $url = $photo->storeAs('books', $filename, 'public');
                $validated['profilePicture'] = $url;

                if ($author->profilePicture) {
                    \Storage::disk('public')->delete($author->profilePicture);
                }
            }

            $author->update($validated);

            return redirect(route('admin.authors.show', $author->id))->with('success', "autor atualizado com sucesso! [#{$author->id}]");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => "Erro ao atualizar o autor!"])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        if ($author->profilePicture) {
            \Storage::disk('public')->delete($author->profilePicture);
        }
        $author->delete();
        return redirect(route('admin.authors.index'));
    }
}
