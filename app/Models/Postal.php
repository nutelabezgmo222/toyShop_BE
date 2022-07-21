<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PostalService;

class Postal extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function postalServices() {
        return $this->hasMany(PostalService::class, 'Postal_id');
    }
}
