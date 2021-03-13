<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_Size extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'product_size';
}
