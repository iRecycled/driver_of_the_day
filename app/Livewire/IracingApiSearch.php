<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;
use iRacingPHP\iRacing;

class IracingApiSearch extends Component
{
    public $searchQuery;
    public $lastFunctionCalled = null;
    public $driversList = [];
    public $leagueList = [];
    public $seasonList = [];
    public $error;
    public $loading = false;

    public function auth() {
        return new iRacing('npeterson1996@gmail.com', 'haXyVVBYhsnNzcjGW2Mv09X//wyfimI2ccDL7YeIp9A=', true);
    }

    public function searchByLeagueName() {
        $this->leagueList = null;
        $this->seasonList = null;
        $this->driversList = null;
        $this->error = null;
        $this->loading = true;
        try {
            $iracing = $this->auth();
            $leagueNames = $iracing->league->directory(['search' => $this->searchQuery]);
            foreach ($leagueNames->results_page as $key => $league) {
                $this->leagueList[$league->league_id] = $league->league_name;
            }
            $this->loading = false;

        } catch (Exception $e){
            $this->loading = false;
            $this->error = $e->getMessage();
        }
        $this->lastFunctionCalled = 'searchByLeagueName';
    }

    public function searchAndShowSeason($leagueId) {
        try {
            $this->loading = true;
            $iracing = $this->auth();
            $seasons = $iracing->league->seasons($leagueId);
            $this->loading = false;
            foreach ($seasons->seasons as $key => $season) {
                $this->seasonList[$season->season_id . "," . $season->league_id] = $season->season_name;
            }
        } catch (Exception $e) {
            $this->loading = false;
            $this->error = $e->getMessage();
        }
        $this->lastFunctionCalled = 'searchAndShowSeason';
    }

    public function searchAndShowDriver($combinedIds) {
        try {
            $this->loading = true;
            $iracing = $this->auth();
            list($seasonId, $leagueId) = explode(',', $combinedIds);
            $drivers = $iracing->league->season_standings($leagueId, $seasonId);
            $this->loading = false;
            foreach($drivers->standings->driver_standings as $key => $driver) {
                $this->driversList[$key] = $driver->driver->display_name;
            }
        } catch (Exception $e) {
            $this->loading = false;
            $this->error = $e->getMessage();
        }
        $this->lastFunctionCalled = 'searchAndShowDriver';
    }

    public function render()
    {
        return view('livewire.iracing-api-search')->with(['drivers' => $this->driversList]);
    }
}
