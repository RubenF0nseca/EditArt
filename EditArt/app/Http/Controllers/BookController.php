<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected function getValidationRules(?Book $book = null): array
    {
        $id = $book ? $book->id : 'NULL';

        return [
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'publicationDate' => 'required|date',
            'editionNumber' => 'required|integer|min:1',
            'isbn' => 'required|string|size:13|unique:books,isbn,' . $id,
            'numberOfPages' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
            'language' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'CoverPicture' => 'nullable|mimes:jpg,png|max:2048',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id', // Garante que os IDs existem na tabela authors
        ];
    }

    protected array $messages = [
        'title.required' => 'O título é obrigatório.',
        'title.string' => 'O título deve ser um texto válido.',
        'title.max' => 'O título não pode exceder 255 caracteres.',

        'type.required' => 'O tipo é obrigatório.',
        'type.string' => 'O tipo deve ser um texto válido.',
        'type.max' => 'O tipo não pode exceder 255 caracteres.',

        'publicationDate.required' => 'A data de publicação é obrigatória.',
        'publicationDate.date' => 'A data de publicação deve ser uma data válida.',

        'editionNumber.required' => 'O número da edição é obrigatório.',
        'editionNumber.integer' => 'O número da edição deve ser um número inteiro.',
        'editionNumber.min' => 'O número da edição deve ser pelo menos 1.',

        'isbn.required' => 'O ISBN é obrigatório.',
        'isbn.string' => 'O ISBN deve ser um texto válido.',
        'isbn.size' => 'O ISBN deve ter exatamente 13 caracteres.',
        'isbn.unique' => 'Este ISBN já foi registado.',

        'numberOfPages.required' => 'O número de páginas é obrigatório.',
        'numberOfPages.integer' => 'O número de páginas deve ser um número inteiro.',
        'numberOfPages.min' => 'O número de páginas deve ser pelo menos 1.',

        'stock.required' => 'O stock é obrigatório.',
        'stock.integer' => 'O stock deve ser um número inteiro.',
        'stock.min' => 'O stock não pode ser negativo.',

        'language.required' => 'O idioma é obrigatório.',
        'language.string' => 'O idioma deve ser um texto válido.',
        'language.max' => 'O idioma não pode exceder 255 caracteres.',

        'price.required' => 'O preço é obrigatório.',
        'price.numeric' => 'O preço deve ser um número.',
        'price.min' => 'O preço deve ser pelo menos 0.',

        'CoverPicture.mimes' => 'A imagem deve estar no formato JPG ou PNG.',
        'CoverPicture.max' => 'A foto do livro não pode exceder 2 MB.',
    ];

    public function index()
    {
        return view('product.index', ['books' => Book::paginate(11)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $authors = Author::all();
        return view('product.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->getValidationRules(), $this->messages);

        try {
            // Upload da imagem, se existir
            if ($request->hasFile('CoverPicture')) {
                $photo = $request->file('CoverPicture');
                $extension = $photo->getClientOriginalExtension();
                $filename = preg_replace('/\s+/', '', strtolower($validated['title'])) . '_' . time() . '.' . $extension;
                $url = $photo->storeAs('books', $filename, 'public');
                $validated['CoverPicture'] = $url;
            }


            //$authors=$validated['authors'];
            $authors = explode(',', $validated['authors'][0]);
            unset($validated['authors']);

            // Criar o livro
            $book = new Book($validated);
            $book->save();
            $book->authors()->attach($authors);


            return redirect(route('books.create'))->with('success', "Livro registado com sucesso! [#{$book->id}]");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => "Erro ao criar o Livro: {$e->getMessage()}"])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('product.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        return view('product.update', compact('book', 'authors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate($this->getValidationRules($book), $this->messages);

        try {
            $photo = $request->file('CoverPicture');
            if ($request->hasFile('CoverPicture')) {


                $extension = pathinfo($photo->getClientOriginalName(), PATHINFO_EXTENSION);
                $filename = preg_replace('/\s+/', '', strtolower($validated['title'])) . '_' . time() . '.' . $extension;

                $url = $photo->storeAs('books', $filename, 'public');
                $validated['CoverPicture'] = $url;

                if ($book->CoverPicture) {
                    \Storage::disk('public')->delete($book->CoverPicture);
                }
            }

            // Atualizar os autores associados
            if ($request->has('authors')) {
                $authors = explode(',', $request->input('authors')[0]); // Converter para array
                $book->authors()->sync($authors);
            } else {
                $book->authors()->detach(); // Remove todos os autores, se não forem selecionados
            }

            $book->update($validated);

            return redirect(route('books.show', $book->id))->with('success', "Livro atualizado com sucesso! [#{$book->id}]");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => "Erro ao atualizar o Livro!"])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        if ($book->CoverPicture) {
            \Storage::disk('public')->delete($book->CoverPicture);
        }
        $book->delete();
        return redirect(route('books.index'));
    }
}
