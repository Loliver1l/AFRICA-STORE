<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index() {
        $cart = session('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request) {
        $data = $request->validate(['product_id'=>'required|exists:products,id','quantity'=>'required|integer|min:1|max:99']);
        $product = Product::findOrFail($data['product_id']);
        abort_unless($product->status === 'available' && $product->stock >= $data['quantity'], 422, 'Product is not available in the requested quantity.');
        $cart = session('cart', []);
        $cart[$product->id] = [
            'id'=>$product->id, 'name'=>$product->name, 'price'=>$product->price_usd,
            'quantity'=>($cart[$product->id]['quantity'] ?? 0) + $data['quantity']
        ];
        session(['cart'=>$cart]);
        return back()->with('success','Added to cart.');
    }

    public function update(Request $request, Product $product) {
        $data = $request->validate(['quantity'=>'required|integer|min:1|max:99']);
        $cart = session('cart', []);
        if (isset($cart[$product->id])) $cart[$product->id]['quantity'] = $data['quantity'];
        session(['cart'=>$cart]);
        return back();
    }

    public function remove(Product $product) {
        $cart = session('cart', []);
        unset($cart[$product->id]);
        session(['cart'=>$cart]);
        return back();
    }
}
