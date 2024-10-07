<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Orders_Details;
use Illuminate\Database\Eloquent\SoftDeletes;


class Orders extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'users_id',
        'fullname',
        'phone',
        'email',
        'address',
        'note',
        'shiptype',
        'total_money',
        'pay',
        'status'
    ];

    public function orderDetails()
    {
        return $this->hasMany(Orders_Details::class, 'orders_id');
    }
}
