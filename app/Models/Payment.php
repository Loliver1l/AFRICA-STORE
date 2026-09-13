<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Payment extends Model
{
    protected $fillable=['order_id','provider','payment_method','currency','amount_usd','amount_crypto','crypto_currency','crypto_network','provider_order_id','provider_transaction_id','provider_reference','idempotency_key','status','provider_response','paid_at','failed_at'];
    protected function casts(): array{return ['amount_usd'=>'decimal:2','amount_crypto'=>'decimal:8','provider_response'=>'array','paid_at'=>'datetime','failed_at'=>'datetime'];}
}
