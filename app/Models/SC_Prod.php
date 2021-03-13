<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SC_Prod extends Model
{
    use HasFactory;
    protected $table = 'product_subcategory';
    public $timestamps = false;
}
