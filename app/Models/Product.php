<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug', 'description', 'price_usd', 'stock', 'status', 'published_at'];

    protected function casts(): array
    {
        return [
            'price_usd' => 'decimal:2',
            'published_at' => 'datetime',
        ];
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function videos()
    {
        return $this->hasMany(ProductVideo::class)->orderBy('sort_order');
    }
}
