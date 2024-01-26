<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function driver() {
        return $this->belongsTo(Driver::class, 'driver_id', 'cust_id');
    }

    public function vote() {
        return $this->belongsTo(Vote::class, 'driver_id', 'driver_id');
    }
}
