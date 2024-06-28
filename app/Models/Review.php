<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $fillable = [
        'receipt_id',
        'rating',
        'comment',
        'created_at',
    ];
}
