<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'created_at',
        'address',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_receipt')
                    ->withPivot('count');
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
}