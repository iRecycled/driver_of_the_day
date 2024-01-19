<?php

namespace App\Livewire;

use Livewire\Component;
use iRacingPHP\iRacing;

class IracingApiSearch extends Component
{
    public $searchQuery;

    public function search() {
        $iracing = new iRacing('npeterson1996@gmail.com', 'haXyVVBYhsnNzcjGW2Mv09X//wyfimI2ccDL7YeIp9A=', true);
        $seasons = $iracing->league->seasons($this->searchQuery);
        $leagueSeasonId = $seasons->seasons[0]->season_id;
        $drivers = $iracing->league->season_standings($this->searchQuery, $leagueSeasonId);
        $driversList = [];
        foreach($drivers->standings->driver_standings as $key => $driver) {
            $driversList[$key] = $driver->driver->display_name;
        }
        dd($driversList);
    }

    public function render()
    {
        return view('livewire.iracing-api-search');
    }
}
