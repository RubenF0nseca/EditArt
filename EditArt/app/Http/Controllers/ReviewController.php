<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected function getValidationRules(?Review $review = null): array
    {
        $id = $review ? $review->id : 'NULL';

        return [
            'book_id' => 'required|integer|exists:books,id',
            'user_id' => 'required|integer|exists:users,id',
            'comment' => 'nullable|string|max:1000',
            'rating' => 'required|integer|between:1,5',
        ];
    }

    protected array $messages = [
        'book_id.required' => 'O ID do livro é obrigatório.',
        'book_id.integer' => 'O ID do livro deve ser um número inteiro.',
        'book_id.exists' => 'O livro selecionado não existe.',

        'user_id.required' => 'O ID do utilizador é obrigatório.',
        'user_id.integer' => 'O ID do utilizador deve ser um número inteiro.',
        'user_id.exists' => 'O utilizador selecionado não existe.',

        'comment.string' => 'O comentário deve ser um texto válido.',
        'comment.max' => 'O comentário não pode exceder 1000 caracteres.',

        'rating.required' => 'A nota é obrigatória.',
        'rating.integer' => 'A nota deve ser um número inteiro.',
        'rating.between' => 'A nota deve estar entre 1 e 5.',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('reviews.index', ['reviews' => Review::paginate(12)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->getValidationRules(), $this->messages);
        try{
            $review = new Review($validated);
            $review->review_date = now();
            $review->save();
            return redirect(route('admin.reviews.create'))->with('success',"Avaliação registada com sucesso! [#{$review->id}]");
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => "Erro ao criar avaliação!"])->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return view('reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        return view('reviews.update', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $validated = $request->validate($this->getValidationRules($review), $this->messages);

        try {
            $review->update($validated);

            return redirect(route('admin.reviews.show', $review->id))->with('success', "Avaliação editada com sucesso! [#{$review->id}]");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => "Erro ao atualizar a avaliação!"])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect(route('admin.reviews.index'));
    }
}
