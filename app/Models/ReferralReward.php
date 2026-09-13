<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ReferralReward extends Model
{
    protected $fillable=['referral_id','order_id','percentage','amount_usd','status','paid_at'];
    protected function casts(): array{return ['percentage'=>'decimal:2','amount_usd'=>'decimal:2','paid_at'=>'datetime'];}
}
