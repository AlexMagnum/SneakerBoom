<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_address',
        'user_id',
        'total_cost',
        'note',
        'created_at',
        'updated_at',
        'paymentsystem',
        'status',
        'name',
        'email',
        'phone'
    ];

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}
