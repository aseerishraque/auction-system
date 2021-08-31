<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_time',
        'close_time',
        'result_time',
        'product_id',
        'category_id',
        'winner_bid',
        'user_id',
        'status',
        'is_delivered',
        'paying_time'
    ];
}
