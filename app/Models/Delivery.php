<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Delivery extends Model
{
    protected $fillable=['order_id','notification_method','email','whatsapp_number','address','city','county','country','status','tracking_number','shipped_at','delivered_at'];
    protected function casts(): array { return ['shipped_at'=>'datetime','delivered_at'=>'datetime']; }
    public function order(){return $this->belongsTo(Order::class);}
}
