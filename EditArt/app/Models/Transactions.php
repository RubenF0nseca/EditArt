<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionsFactory> */
    use HasFactory;

    /**
     * Relacionamento com o user que realizou a transação.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Relacionamento com o staff que processou a transação.
     */
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id', 'id');
    }
}
