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

    /**
     * Delivers the votes grouped by each name
     */
    public function votesByDriverName() {
        return $this->votes()
            ->with('driver')
            ->get()
            ->groupBy('driver.name')
            ->map(function ($votes) {
                return [
                    'count' => $votes->count(),
                    'votes' => $votes,
                ];
            });
    }

    /**
     * Delivers the votes grouped by each name
     */
    public function voteCounts() {
        return $this->votes()
            ->with('driver')
            ->get()
            ->groupBy('driver.name')
            ->map(function ($votes) {
                return [
                    'count' => $votes->count(),
                ];
            });
    }
}
