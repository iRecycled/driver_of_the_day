<?php

namespace App\Livewire;
use App\Models\Race;
use App\Models\Vote;
use App\Models\Driver;
use Livewire\Component;

class DotdStreamerResultsPage extends Component
{
    public $id;

    public function render()
    {
        $race = Race::where('session_id', $this->id)->first();
        $drivers = $race->drivers()->get();
        $top3 = $drivers->sortByDesc(function ($driver) use ($race) {
            return $driver->votes->where('race_id', $race->id)->count();
        })->take(3);
        $totalVotes = $race->getTotalVotes();

        return view('livewire.dotd-streamer-results-page', [
            'drivers' => $top3,
            'totalVotes' => $totalVotes,
            'race' => $race,
        ]);
    }
}
