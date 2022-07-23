<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Toy;
use App\Models\OrderStatus;
use App\Models\Delivery;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'creation_date',
        'completition_date',
        'Delivery_id',
        'OrderStatus_id',
        'User_id',
    ];

    public $timestamps = false;

    public function toyOrders() {
        return $this->belongsToMany(Toy::class, 'toy_orders', 'Order_id', 'Toy_id')->withPivot('quantity', 'price');
    }
    
    public function status() {
        return $this->belongsTo(OrderStatus::class, 'OrderStatus_id');
    }

    public function delivery() {
        return $this->belongsTo(Delivery::class, 'Delivery_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'User_id');
    }
}
