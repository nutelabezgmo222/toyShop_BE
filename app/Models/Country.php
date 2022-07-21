<?php

namespace App\Models;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function brands() {
        return $this->hasMany(Brand::class, 'Country_id');
    }

    public function cities() {
        return $this->hasMany(City::class, 'Country_id');
    }
}
