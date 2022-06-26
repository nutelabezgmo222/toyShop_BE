<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

      protected $fillable = [
          'title',
          'Category_id'
      ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'Category_id'
    ];

    public function toys() {
        return $this->belongsToMany(Toy::class, 'toy_subcategories', 'SubCategory_id', 'Toy_id');
    }
}
