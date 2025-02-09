<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    public function show($id)
    {
        $transaction = Transaction::with('items.book')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('client.orderHistory', compact('transaction'));
    }

}
