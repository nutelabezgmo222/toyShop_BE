<?php

namespace App\Models;

use App\Models\Toy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgeLimit extends Model
{
    use HasFactory;

    protected $hidden = [
        'toys',
    ];

    public function toys() {
        return $this->hasMany(Toy::class, 'AgeLimit_id');
    }
}
