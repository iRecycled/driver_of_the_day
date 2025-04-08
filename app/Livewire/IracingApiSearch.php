<?php

namespace App\Livewire;

use Exception;
use Livewire\Component;
use iRacingPHP\iRacing;
use Illuminate\Support\Facades\Cache;

use App\Models\Race;

use Carbon\Carbon;

class IracingApiSearch extends Component
{
    public $searchQuery;
    public $lastFunctionCalled = null;
    public $sessionsList = [];
    public $leagueList = [];
    public $seasonList = [];
    public $leagueId;
    public $seasonId;
    public $sessionId;
    public $error;
    public $loading = false;
    public $deferredSeasonSearch;
    public $deferredLeagueId;

    public function auth() {
        return new iRacing(env('IRACING_EMAIL'), env('IRACING_PASSWORD'), env('IRACING_COOKIE_PATH'));
    }

    public function mount() {
        $leagueId = request()->query('leagueId');
        $seasonId = request()->query('seasonId');

        if ($leagueId) {
            $this->leagueId = (int)$leagueId;
            $this->searchAndShowSeason($this->leagueId);

            if ($seasonId) {
                $this->seasonId = (int)$seasonId;
                $this->searchAndShowSession($this->seasonId . ',' . $this->leagueId);
            }
        }
    }

    public function searchByLeagueName() {
        $this->leagueList = null;
        $this->seasonList = null;
        $this->sessionsList = null;
        $this->error = null;
        $this->loading = true;
        try {
            $iracing = $this->auth();
            $cacheKey = 'leagueNames_' . md5($this->searchQuery);

            $leagueNames = Cache::remember($cacheKey, 180, function () use ($iracing) {
                return $iracing->league->directory(['search' => $this->searchQuery]);
            });

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

    public function searchAndShowSeason($leagueId)
    {
        try {
            $this->loading = true;
            $iracing = $this->auth();
            $seasons = Cache::remember('seasons_' . $leagueId, 180, function () use ($iracing, $leagueId) {
                return $iracing->league->seasons($leagueId);
            });
            $this->loading = false;
            foreach ($seasons->seasons as $key => $season) {
                $this->seasonList[$season->season_id . "," . $season->league_id] = $season->season_name;
            }

            $this->lastFunctionCalled = 'searchAndShowSeason';

            if ($this->deferredSeasonSearch && $this->deferredLeagueId) {
                $this->searchAndShowSession($this->deferredSeasonSearch . ',' . $this->deferredLeagueId);
                $this->deferredSeasonSearch = null;
                $this->deferredLeagueId = null;
            }

        } catch (Exception $e) {
            $this->loading = false;
            $this->error = $e->getMessage();
        }
    }

    public function searchAndShowSession($combinedIds) {
        try {
            $this->loading = true;
            $iracing = $this->auth();
            list($seasonId, $leagueId) = explode(',', $combinedIds);
            $allSessions = $iracing->league->season_sessions($leagueId, $seasonId);
            $this->loading = false;
            foreach($allSessions->sessions as $session) {
                if(isset($session->subsession_id)){
                    $this->sessionsList[$session->subsession_id] = [
                        $session->track->track_name,
                        Carbon::parse($session->launch_at)->format('F jS, Y')
                    ];

                    $race = Race::updateOrCreate(
                        ['session_id' => $session->subsession_id, 'league_id' => $leagueId],
                        [
                            'track_name' => $session->track->track_name,
                            'race_time' => Carbon::parse($session->launch_at),
                            'time_limit' => $session->time_limit,
                            'season_id' => $session->league_season_id,
                        ]
                    );

                    Cache::put('league_session_'.$session->subsession_id, ['leagueId' => $leagueId, 'seasonId' => $seasonId], 3600);
                }
            }
        } catch (Exception $e) {
            $this->loading = false;
            $this->error = $e->getMessage();
        }
        $this->lastFunctionCalled = 'searchAndShowSession';
    }

    public function render()
    {
        return view('livewire.iracing-api-search');
    }

    protected $listeners = ['restoreSearchState', 'runSearchSession'];

    public function restoreSearchState($params = [])
    {
        logger('Restoring search state with', $params);

        $this->reset(['leagueList', 'seasonList', 'sessionsList', 'error', 'lastFunctionCalled']);

        if (isset($params['leagueId'])) {
            $this->leagueId = (int)$params['leagueId'];
            $this->searchAndShowSeason($this->leagueId);

            if (isset($params['seasonId'])) {
                $this->seasonId = (int)$params['seasonId'];
                $this->searchAndShowSession($this->seasonId . ',' . $this->leagueId);
            }
        }
    }

    public function runSearchSession($params)
    {
        $this->searchAndShowSession($params['seasonId'] . ',' . $params['leagueId']);
    }
}
