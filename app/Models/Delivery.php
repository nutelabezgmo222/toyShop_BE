<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;
use App\Models\PostalService;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'PostalService_id',
        'City_id'
    ];

    public $timestamps = false;

    public function city() {
        return $this->belongsTo(City::class, 'City_id');
    }
    public function postalService() {
        return $this->belongsTo(PostalService::class, 'PostalService_id');
    }
}
