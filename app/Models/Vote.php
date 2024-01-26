<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function driver() {
        return $this->belongsTo(Driver::class, 'cust_id', 'driver_id');
    }

    public function race() {
        return $this->belongsTo(Race::class);
    }
}
