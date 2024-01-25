<?php

namespace App\Livewire;

use iRacingPHP\iRacing;
use Livewire\Component;
use App\Models\Driver;
use App\Models\Vote;

class DotdDriverVote extends Component
{
    public $leagueId;
    public $seasonId;
    public $id;

    public function auth() {
        return new iRacing('npeterson1996@gmail.com', 'haXyVVBYhsnNzcjGW2Mv09X//wyfimI2ccDL7YeIp9A=', true);
    }

    public function getDrivers() {
        $iracing = $this->auth();
        $drivers = $iracing->lookup->drivers(" ", ['league_id' => $this->leagueId]);
        $this->setDriver($drivers);
        return $drivers;
    }

    public function setDriver($drivers) {
        foreach ($drivers as $key => $driver) {
            Driver::firstOrCreate([
                'name' => $driver->display_name,
                'cust_id' => $driver->cust_id
            ]);
        }
    }

    public function castVote($driver){
        Vote::insert([
            'driver_name' => $driver['display_name'],
            'driver_id' => $driver['cust_id'],
            'league_id' => $this->leagueId,
            'session_id' => $this->id,
            'ip_address' => request()->ip()
        ]);
    }

    public function render()
    {
        $drivers = $this->getDrivers();
        return view('livewire.dotd-driver-vote', compact('drivers'));
    }
}
