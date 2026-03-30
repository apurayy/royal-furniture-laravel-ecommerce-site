<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
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

    private function saveCart(array $cart)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $user->cart = $cart;
            $user->save();
        } else {
            session()->put('cart', $cart);
        }
    }

    public static function syncGuestCartToUser()
    {
        if (!auth()->check()) {
            return;
        }

        $guestCart = session()->get('cart', []);
        if (empty($guestCart)) {
            return;
        }

        $user = auth()->user();
        $userCart = $user->cart;

        if (is_string($userCart)) {
            $userCart = json_decode($userCart, true);
        }

        $userCart = is_array($userCart) ? $userCart : [];

        foreach ($guestCart as $productId => $item) {
            if (isset($userCart[$productId])) {
                $userCart[$productId]['quantity'] += $item['quantity'];
            } else {
                $userCart[$productId] = $item;
            }
        }

        $user->cart = $userCart;
        $user->save();

        session()->forget('cart');
    }

    public function index()
    {
        $cart = $this->getCart();
        return view('frontend.cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $cart = $this->getCart();
        $key = $product->id;

        if (isset($cart[$key])) {
            $cart[$key]['quantity'] += $request->quantity ?? 1;
        } else {
            $cart[$key] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->first_image,
                'quantity' => $request->quantity ?? 1,
            ];
        }

        $this->saveCart($cart);

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart!',
            'cart_count' => array_sum(array_column($cart, 'quantity'))
        ]);
    }

    public function update(Request $request)
    {
        $cart = $this->getCart();

        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = (int) $request->quantity;
            $this->saveCart($cart);
        }

        return response()->json(['success' => true]);
    }

    public function remove(Request $request)
    {
        $cart = $this->getCart();

        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            $this->saveCart($cart);
        }

        return response()->json(['success' => true]);
    }
}
