<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'creation_date',
        'completition_date',
        'Delivery_id',
        'User_id',
    ];

    public $timestamps = false;
}
