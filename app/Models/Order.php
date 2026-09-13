<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Order extends Model
{
    protected $fillable = ['user_id','order_number','subtotal_usd','delivery_fee_usd','total_usd','status','notes'];
    protected function casts(): array { return ['subtotal_usd'=>'decimal:2','delivery_fee_usd'=>'decimal:2','total_usd'=>'decimal:2']; }
    public function items() { return $this->hasMany(OrderItem::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function delivery() { return $this->hasOne(Delivery::class); }
}
