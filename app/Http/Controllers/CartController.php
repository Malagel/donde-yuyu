<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', [
            'cart' => $cart,
            'total' => $total,
        ]);
    }

    public function add(Request $request, $id)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $quantity = (int)$validated['quantity'];

        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Producto añadido al carrito!');
    }

    public function clear()
    {
        session()->forget('cart');
        return back();
    }

    public function checkout()
    {
        if (!Auth::check()) {
            return redirect('/login')->withErrors([
                'email' => 'Debes iniciar sesión para completar tu compra.',
            ]);
        }

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Tu carrito está vacío.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        DB::transaction(function () use ($cart, $total) {
            $order = Order::create([
                'user_id'      => Auth::id(),
                'total_amount' => $total,
                'status'       => 'completed',
            ]);

            foreach ($cart as $productId => $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $productId,
                    'price'      => $item['price'],
                    'quantity'   => $item['quantity'],
                ]);
            }
        });

        session()->forget('cart');

        return redirect('/cart')->with('success', '¡Compra realizada con éxito! Tu pedido ha sido guardado.');
    }
}