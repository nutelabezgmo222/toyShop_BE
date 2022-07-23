<?php

namespace App\Models;

use App\Models\SubCategory;
use App\Models\GenderCategory;
use App\Models\AgeLimit;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toy extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'rating',
        'number',
        'GenderCategory_id',
        'AgeLimit_id',
        'Brand_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'GenderCategory_id',
        'AgeLimit_id',
        'Brand_id'
    ];

    public function subCategories() {
        return $this->belongsToMany(SubCategory::class, 'toy_subcategories', 'Toy_id', 'Subcategory_id');
    }

    public function genderCategory() {
        return $this->belongsTo(GenderCategory::class, 'GenderCategory_id');
    }

    public function ageLimit() {
        return $this->belongsTo(AgeLimit::class, 'AgeLimit_id');
    }

    public function brand() {
        return $this->belongsTo(Brand::class, 'Brand_id');
    }
}
