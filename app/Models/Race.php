<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    protected $guarded = [];
    use HasFactory;
    public function drivers() {
        return $this->belongsToMany(Driver::class)->withTimestamps();
    }

    public function votes() {
        return $this->hasMany(Vote::class);
    }

    public function getTotalVotes() {
        return $this->votes()->count();
    }
}
