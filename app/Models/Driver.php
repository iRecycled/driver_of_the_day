<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function races() {
        return $this->belongsToMany(Race::class);
    }

    public function votes() {
        return $this->hasMany(Vote::class);
    }
}
