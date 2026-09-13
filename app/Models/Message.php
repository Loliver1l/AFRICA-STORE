<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Message extends Model
{
    protected $fillable=['sender_id','receiver_id','subject','message','status','read_at'];
    protected function casts(): array{return ['read_at'=>'datetime'];}
}
