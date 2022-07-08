<?php

namespace App\Models;

use App\Models\Country;
use App\Models\Toy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'country_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'Country_id',
        'toys',
    ];

    public function country() {
        return $this->belongsTo(Country::class, 'Country_id');
    }

    public function toys() {
        return $this->hasMany(Toy::class, 'Brand_id');
    }
}
