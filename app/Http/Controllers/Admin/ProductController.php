<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index() { return view('admin.products.index',['products'=>Product::latest()->paginate(20)]); }
    public function create() { return view('admin.products.create'); }
    public function store(Request $request) {
        $data=$request->validate(['name'=>'required|max:255','description'=>'nullable','price_usd'=>'required|numeric|min:0','stock'=>'required|integer|min:0','status'=>'required|in:available,coming_soon,out_of_stock,draft']);
        $data['slug']=Str::slug($data['name']).'-'.Str::lower(Str::random(5));
        Product::create($data);
        return redirect()->route('admin.products.index')->with('success','Product created.');
    }
    public function edit(Product $product) { return view('admin.products.edit',compact('product')); }
    public function update(Request $request, Product $product) {
        $data=$request->validate(['name'=>'required|max:255','description'=>'nullable','price_usd'=>'required|numeric|min:0','stock'=>'required|integer|min:0','status'=>'required|in:available,coming_soon,out_of_stock,draft']);
        $data['slug']=Str::slug($data['name']).'-'.Str::lower(Str::random(5));
        $product->update($data); return redirect()->route('admin.products.index')->with('success','Product updated.');
    }
    public function destroy(Product $product) { $product->delete(); return back()->with('success','Product deleted.'); }
}
