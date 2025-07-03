<?php
// app/Http/Controllers/CheckoutController.php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class CheckoutController extends Controller
{
    public function processPayment(Request $request)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount'   => $request->total * 100, // Convert to cents
                'currency' => 'usd',
                'metadata' => [
                    'order_id' => uniqid(),
                    'user_id'  => auth()->id(),
                ],
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function confirmPayment(Request $request)
    {
        $validated = $request->validate([
            'payment_intent_id' => 'required',
            'amount'            => 'required|numeric',
            'shipping_address'  => 'required',
            'billing_address'   => 'required',
        ]);

        // Create order
        $order = Order::create([
            'user_id'          => auth()->id(),
            'total'            => $validated['amount'],
            'payment_method'   => 'stripe',
            'transaction_id'   => $validated['payment_intent_id'],
            'payment_status'   => 'paid',
            'shipping_address' => $validated['shipping_address'],
            'billing_address'  => $validated['billing_address'],
            'status'           => 'processing',
        ]);

        return redirect()->route('thankyou', $order->id);
    }
    public function handleFailedPayment(Request $request)
{
    return view('payment-failed')->withErrors([
        'payment' => 'Your payment failed. Please try again.'
    ]);
}
}
