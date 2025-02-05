<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Transactions;
use Illuminate\Http\Request;

class PayPalController extends Controller
{
    public function completePayment(Request $request)
    {
        // Obter os detalhes da transação do PayPal e os dados do endereço enviados via AJAX
        $transactionDetails = $request->input('transactionDetails');
        $billingData = $request->input('billingData');

        // Obter o valor pago (ajuste conforme o retorno da API do PayPal)
        $paidAmount = $transactionDetails['purchase_units'][0]['amount']['value'];

        // Atualizar os dados de endereço do usuário (exceto nome e email)
        $user = auth()->user();
        if ($billingData && $user) {
            $user->update([
                'address'      => $billingData['address'],
                'locality'     => $billingData['locality'],
                'postal_code'  => $billingData['postal_code'],
                'nif'          => $billingData['nif'],
                'phone_number' => $billingData['phone_number'],
            ]);
        }

        // Crie um registro na tabela transactions, salvando também os dados do endereço
        $transaction = Transactions::create([
            'user_id'          => $user->id,
            'price'            => $paidAmount,
            'transaction_date' => now(),
            'delivery_date'    => now()->addDays(7),
            'user_address'     => $billingData['address'],
            'user_postal_code' => $billingData['postal_code'],
            'user_locality'    => $billingData['locality'],
            'user_phone_number'=> $billingData['phone_number'],
            'user_nif'         => $billingData['nif'],
        ]);

        // Recuperar os itens do carrinho para o usuário autenticado
        $cartItems = Cart::with('book')->where('user_id', $user->id)->get();

        // Para cada item, crie um registro na tabela transaction_items
        foreach ($cartItems as $item) {
            \Log::info('Criando TransactionItem para book_id: ' . $item->book_id, [
                'quantity' => $item->quantity,
                'unit_price' => $item->book->price,
            ]);
            $transaction->items()->create([
                'book_id'    => $item->book_id,
                'quantity'   => $item->quantity,
                'unit_price' => $item->book->price,
            ]);
        }

        // Limpar o carrinho
        Cart::where('user_id', $user->id)->delete();

        return response()->json(['success' => true]);
    }

    public function orderConfirmation()
    {
        // Recuperar a última transação do usuário
        $transaction = Transactions::with('items.book')
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->first();

        return view('cart.confirmation', compact('transaction'));
    }
}
