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
    public $leagueId;
    public $seasonId;
    public $id;

    public function auth() {
        return new iRacing(env('IRACING_EMAIL'), env('IRACING_PASSWORD'), env('IRACING_COOKIE_PATH'));
    }

    public function getDrivers() {
        $iracing = $this->auth();
        $drivers = $iracing->lookup->drivers(" ", ['league_id' => $this->leagueId]);
        $allSessions = $iracing->league->season_sessions($this->leagueId, $this->seasonId);
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
            if($sesh->subsession_id == $this->id) {
                return Race::firstOrCreate(
                    [
                    'session_id' => $this->id,
                    'league_id' => $this->leagueId,
                    ], [
                    'season_id' => $this->seasonId,
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

    public function castVote($vote){
        $race = Race::where('session_id', $this->id)->first();
        $driver = Driver::where('cust_id', $vote['cust_id'])->first();

        $vote = Vote::updateOrCreate([
            'session_id' => $this->id,
            'ip_address' => request()->ip()
        ],
        [
            'driver_name' => $driver->name,
            'driver_id' => $driver->cust_id,
            'league_id' => $this->leagueId
        ]
        );
        $existingRecord = DB::table('driver_race_votes')
        ->where('vote_id', $vote->id)
        ->first();
        if($existingRecord) {
            DB::table('driver_race_votes')
            ->where('vote_id', $vote->id)
            ->delete();
        }

        $vote->drivers()->attach($driver->id, ['race_id' => $race->id]);
        return redirect('/race/'. $this->id .'/results');
    }

    public function render()
    {
        $drivers = $this->getDrivers();
        return view('livewire.dotd-driver-vote', compact('drivers'));
    }
}
