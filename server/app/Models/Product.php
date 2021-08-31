<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'product_name',
        'slug',
        'model_no',
        'grade',
        'sku',
        'description',
        'specification',
        'base_price',
        'expected_value',
        'percentage',
        'front_image',
        'back_image',
        'left_image',
        'right_image',
        'is_sold',
    ];

}
