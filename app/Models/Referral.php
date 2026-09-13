<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Referral extends Model
{
    protected $fillable=['referrer_id','referred_user_id','referral_code','status'];
}
