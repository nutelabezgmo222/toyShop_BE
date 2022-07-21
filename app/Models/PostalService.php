<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Postal;

class PostalService extends Model
{
    use HasFactory;

    public function postal() {
        return $this->belongsTo(Postal::class, 'Postal_id');
    }
}
