<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function drivers() {
        return $this->belongsToMany(Driver::class, 'driver_race_votes')->withTimestamps();
    }

    public function race() {
        return $this->belongsTo(Race::class);
    }

    public function attachDriver($driverId, $raceId)
    {
        $this->drivers()->attach($driverId, ['race_id', $raceId]);
    }
}
