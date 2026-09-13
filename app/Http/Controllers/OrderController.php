<?php
namespace App\Http\Controllers;
use App\Models\Order;
class OrderController extends Controller
{
    public function index() { return view('orders.index',['orders'=>auth()->user()->orders()->latest()->paginate(15)]); }
    public function show(Order $order) { abort_unless($order->user_id === auth()->id(),403); return view('orders.show',compact('order')); }
}
