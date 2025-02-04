<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionsFactory> */
    use HasFactory;
    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'price',
        'transaction_date',
        'delivery_date',
        'user_address',
        'user_postal_code',
        'user_locality',
        'user_phone_number',
        'user_nif',
    ];

    /**
     * Relacionamento com o user que compra.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relacionamento com os itens desta transação.
     * Cada transação pode ter vários itens.
     */
    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
