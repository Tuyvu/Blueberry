<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Database\Eloquent\SoftDeletes;



class Orders_Details extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'orders_id',
        'product_id',
        'price',
        'discount',
        'total_money',
    ];

    public function order()
    {
        return $this->belongsTo(Orders::class, 'orders_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
