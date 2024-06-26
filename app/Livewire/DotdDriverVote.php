<?php

namespace App\Livewire;

use iRacingPHP\iRacing;
use Livewire\Component;
use App\Models\Driver;
use App\Models\Vote;
use App\Models\Race;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DotdDriverVote extends Component
{
    public $race;

    public function auth() {
        return new iRacing(env('IRACING_EMAIL'), env('IRACING_PASSWORD'), env('IRACING_COOKIE_PATH'));
    }

    public function getDrivers() {
        $iracing = $this->auth();
        // $drivers = $iracing->lookup->drivers(" ", ['league_id' => $this->race->league_id]);
        $league = $iracing->league->get($this->race->league_id);
        $drivers = $league->roster;
        $allSessions = $iracing->league->season_sessions($this->race->league_id, $this->race->season_id);
        $driverModels = $this->setDrivers($drivers);
        $race = $this->setRace($allSessions);
        $this->attachDrivers($race, $driverModels);
        return $drivers;
    }

    public function setDrivers($drivers) {
        $driverModels = [];
        foreach ($drivers as $key => $driver) {
            $driverModels[] = Driver::firstOrCreate([
                'name' => $driver->display_name,
                'cust_id' => $driver->cust_id
            ]);
        }
        return $driverModels;
    }

    public function setRace($allSessions) {
        foreach ($allSessions->sessions as $sesh) {
            if($sesh->subsession_id == $this->race->session_id) {
                return Race::firstOrCreate(
                    [
                    'session_id' => $this->race->session_id,
                    'league_id' => $this->race->league_id,
                    ], [
                    'season_id' => $this->race->season_id,
                    'track_name' => $sesh->track->track_name,
                    'race_time' => Carbon::parse($sesh->launch_at)
                ]);
            }
        }
    }

    public function attachDrivers($race, $drivers) {
        foreach ($drivers as $driver) {
            $race->drivers()->sync($driver, false);
        }
    }

    public function castVote($driver){
        $race = Race::where('session_id', $this->race->session_id)->first();
        $driver = Driver::where('cust_id', $driver['cust_id'])->first();
        Vote::updateOrCreate([
            'race_id' => $race->id,
            'ip_address' => request()->ip()
        ],
        [
            'driver_id' => $driver->id,
        ]
        );
        return redirect('/race/'. $this->race->session_id .'/results');
    }

    public function render()
    {
        $drivers = $this->getDrivers();
        return view('livewire.dotd-driver-vote', compact('drivers'));
    }
}
