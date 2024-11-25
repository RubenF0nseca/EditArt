<?php

namespace App\Http\Controllers;

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
            'CoverPicture' => 'nullable|image|max:2048'
        ];
    }

    protected array $messages = [
        'title.required' => 'The title is required.',
        'title.string' => 'The title must be a valid string.',
        'title.max' => 'The title may not exceed 255 characters.',

        'type.required' => 'The type is required.',
        'type.string' => 'The type must be a valid string.',
        'type.max' => 'The type may not exceed 255 characters.',

        'publicationDate.required' => 'The publication date is required.',
        'publicationDate.date' => 'The publication date must be a valid date.',

        'editionNumber.required' => 'The edition number is required.',
        'editionNumber.integer' => 'The edition number must be an integer.',
        'editionNumber.min' => 'The edition number must be at least 1.',

        'isbn.required' => 'The ISBN is required.',
        'isbn.string' => 'The ISBN must be a valid string.',
        'isbn.size' => 'The ISBN must be exactly 13 characters.',
        'isbn.unique' => 'This ISBN has already been taken.',

        'numberOfPages.required' => 'The number of pages is required.',
        'numberOfPages.integer' => 'The number of pages must be an integer.',
        'numberOfPages.min' => 'The number of pages must be at least 1.',

        'stock.required' => 'The stock is required.',
        'stock.integer' => 'The stock must be an integer.',
        'stock.min' => 'The stock cannot be negative.',

        'language.required' => 'The language is required.',
        'language.string' => 'The language must be a valid string.',
        'language.max' => 'The language may not exceed 255 characters.',

        'price.required' => 'The price is required.',
        'price.numeric' => 'The price must be a number.',
        'price.min' => 'The price must be at least 0.',
    ];


    public function index()
    {
        return view('product.index', ['books' => Book::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->getValidationRules(), $this->messages);

        try {
            if ($request->hasFile('CoverPicture')) {
                $photo = $request->file('CoverPicture');

                $extension = pathinfo($photo->getClientOriginalName(), PATHINFO_EXTENSION);

                $filename = preg_replace('/\s+/', '', strtolower($validated['title'])) . '_' . time() . '.' . $extension;

                $url = $photo->storeAs('books', $filename, 'public');
                $validated['CoverPicture'] = $url;
            }

            $book = new Book($validated);
            $book->save();

            return redirect(route('books.create'))->with('success', "Livro registado com sucesso! [#{$book->id}]");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => "Erro ao criar um Livro!"])->withInput();
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
        return view('product.update', compact('book'));
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

                // Remover a imagem anterior TODO perguntar ao grupo se quer isto
                if ($book->CoverPicture) {
                    \Storage::disk('public')->delete($book->CoverPicture);
                }
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
