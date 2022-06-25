<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public function toys() {
        return $this->belongsToMany(Toy::class, 'toy_subcategories', 'SubCategory_id', 'Toy_id');
    }
}
