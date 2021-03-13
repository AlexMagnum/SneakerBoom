<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategory;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function subcategory()
    {
        return $this->belongsToMany(Subcategory::class);
    }

    public function size()
    {
        return $this->belongsToMany(Size::class);
    }

    public function order()
    {
        return $this->belongsToMany(Order::class);
    }

    public function getNextId()
    {
        $statement = DB::select("show table status like 'products'");

        return $statement[0]->Auto_increment;
    }
}
