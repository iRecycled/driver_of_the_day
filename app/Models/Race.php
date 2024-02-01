<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;
use DateTimeZone;

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

    public function getTimeLeftToVote() {
        $raceStartTime = new DateTime($this->race_time, new DateTimeZone('UTC'));
        $raceEndTime = clone $raceStartTime;
        $raceEndTime->modify("+{$this->time_limit} minutes");
        $currentTime = new DateTime('now', new DateTimeZone('UTC'));
        $countdown = null;
        if($currentTime >= $raceStartTime && $currentTime <= $raceEndTime) {
            $countdown = $raceEndTime->getTimestamp() - $currentTime->getTimestamp();
        }
        return $countdown;
    }

    public function getTotalVotes() {
        return $this->votes()->count();
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
