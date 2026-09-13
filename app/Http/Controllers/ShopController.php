<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function home() { return view('shop.home', ['products' => Product::where('status','available')->with('images')->latest()->take(12)->get()]); }
    public function index() { return view('shop.index', ['products' => Product::whereIn('status',['available','coming_soon'])->with('images')->latest()->paginate(12)]); }
    public function show(Product $product) { return view('shop.show', compact('product')); }
    public function available() { return view('shop.index', ['products' => Product::where('status','available')->with('images')->latest()->paginate(12)]); }
    public function comingSoon() { return view('shop.index', ['products' => Product::where('status','coming_soon')->with('images')->latest()->paginate(12)]); }
    public function search(Request $request) {
        $q = trim($request->string('q'));
        $products = Product::where('status','available')->when($q, fn($x) => $x->where(fn($y) => $y->where('name','like',"%{$q}%")->orWhere('description','like',"%{$q}%")))->paginate(12)->withQueryString();
        return view('shop.index', compact('products','q'));
    }
}
