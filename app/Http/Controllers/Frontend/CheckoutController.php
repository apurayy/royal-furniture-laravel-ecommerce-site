<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Setting;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private function getCart()
    {
        if (auth()->check()) {
            $cart = auth()->user()->cart;
            if (is_string($cart)) {
                $cart = json_decode($cart, true);
            }
            return is_array($cart) ? $cart : [];
        }

        return session()->get('cart', []);
    }

    private function clearCart()
    {
        if (auth()->check()) {
            $user = auth()->user();
            $user->cart = [];
            $user->save();
        }

        session()->forget('cart');
    }

    public function index()
    {
        $cart = $this->getCart();

        if (empty($cart)) {
            return redirect()->route('shop')->with('error', 'Your cart is empty.');
        }

        $subtotal = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        $shippingCost = (float) Setting::get('shipping_cost', 0);
        $taxRate = (float) Setting::get('tax_rate', 0);
        $tax = $subtotal * ($taxRate / 100);
        $total = $subtotal + $shippingCost + $tax;

        return view('frontend.checkout', compact('cart', 'subtotal', 'shippingCost', 'tax', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'payment_method' => 'required|in:cod,bank_transfer',
        ]);

        $cart = $this->getCart();

        if (empty($cart)) {
            return redirect()->route('shop')->with('error', 'Your cart is empty.');
        }

        $subtotal = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        $shippingCost = (float) Setting::get('shipping_cost', 0);
        $taxRate = (float) Setting::get('tax_rate', 0);
        $tax = $subtotal * ($taxRate / 100);
        $total = $subtotal + $shippingCost + $tax;

        $userId = auth()->check() ? auth()->id() : null;

        $shippingAddress = json_encode([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
        ]);

        $order = Order::create([
            'user_id' => $userId,
            'order_number' => Order::generateOrderNumber(),
            'subtotal' => $subtotal,
            'shipping_cost' => $shippingCost,
            'tax' => $tax,
            'total' => $total,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'shipping_address' => $shippingAddress,
            'notes' => $request->notes,
        ]);

        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'product_price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['price'] * $item['quantity'],
            ]);
        }

        $this->clearCart();

        return redirect()->route('order.confirmation', $order->id)->with('success', 'Order placed successfully!');
    }

    public function confirmation(Order $order)
    {
        $order->load('items.product');

        $shipping = json_decode($order->shipping_address, true) ?? [];

        return view('frontend.order-confirmation', compact('order', 'shipping'));
    }
}
