<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class OrderItem extends Model
{
    protected $fillable = ['order_id','product_id','product_name','unit_price_usd','quantity','total_usd'];
    protected function casts(): array { return ['unit_price_usd'=>'decimal:2','total_usd'=>'decimal:2']; }
    public function order() { return $this->belongsTo(Order::class); }
    public function product() { return $this->belongsTo(Product::class); }
}
