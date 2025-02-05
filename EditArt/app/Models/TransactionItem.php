<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    protected $fillable = [
        'transaction_id',
        'book_id',
        'quantity',
        'unit_price',
    ];

    /**
     * Relacionamento com a transação.
     */
    public function transaction()
    {
        return $this->belongsTo(Transactions::class, 'transaction_id');
    }

    /**
     * Relacionamento com o livro.
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
