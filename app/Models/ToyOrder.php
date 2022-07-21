<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToyOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'Toy_id',
        'Order_id',
        'quantity',
        'price',
    ];

    public $timestamps = false;
    protected $primaryKey = ['Toy_id', 'Order_id'];
    public $incrementing = false;
}
