<?php
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index() { return view('checkout.index', ['cart'=>session('cart',[])]); }

    public function store(Request $request) {
        $data = $request->validate([
            'address'=>'required|string|max:500','city'=>'required|string|max:120','country'=>'required|string|max:80',
            'notification_method'=>'required|in:email,whatsapp,both','payment_method'=>'required|in:paystack_mpesa,paystack_card,binance_crypto'
        ]);
        $cart = session('cart', []);
        abort_if(!$cart, 422, 'Your cart is empty.');
        $subtotal = collect($cart)->sum(fn($i) => (float)$i['price'] * (int)$i['quantity']);
        $order = Order::create([
            'user_id'=>auth()->id(),'order_number'=>'EA-'.strtoupper(Str::random(10)),
            'subtotal_usd'=>$subtotal,'delivery_fee_usd'=>0,'total_usd'=>$subtotal,'status'=>'pending_payment'
        ]);
        foreach ($cart as $item) $order->items()->create([
            'product_id'=>$item['id'],'product_name'=>$item['name'],'unit_price_usd'=>$item['price'],
            'quantity'=>$item['quantity'],'total_usd'=>(float)$item['price']*(int)$item['quantity']
        ]);
        $order->delivery()->create([
            'notification_method'=>$data['notification_method'],'email'=>auth()->user()->email,
            'whatsapp_number'=>auth()->user()->whatsapp_number,'address'=>$data['address'],
            'city'=>$data['city'],'country'=>$data['country']
        ]);
        session()->forget('cart');
        return redirect()->route('orders.show',$order)->with('success','Order created. Payment integration can now be connected.');
    }
}
