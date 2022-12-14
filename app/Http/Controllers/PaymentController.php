<?php

namespace App\Http\Controllers;

use App\Classes\Api\Freekassa\Wallet;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(/* Product $product */)
    {
        $sum = 10; /* $product->cost */

        $wallet = new Wallet();
        $order = $wallet->payment(1, 1, 1, 'test@dev.com', '127.0.0.1', $sum, 'RUB');
        $order_link = $order['location'];

        return view('payment.index', compact('order_link'));
    }
}
