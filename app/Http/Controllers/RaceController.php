<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\Vote;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class RaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function view()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create() {
        return view('race.create');
    }


    public function vote($id) {
        $leagueId = null;
        $seasonId = null;
        if(Cache::get('league_session_'.$id) != null) {
            $session = Cache::get('league_session_'.$id);
            $leagueId = $session['leagueId'];
            $seasonId = $session['seasonId'];
        } else {
            $session = Race::where('session_id', $id)->first();
            $leagueId = $session->league_id;
            $seasonId = $session->season_id;
        }
        return view('race.vote', ['leagueId' => $leagueId, 'seasonId' => $seasonId, 'id' => $id]);
    }

    public function results($id) {
        $race = Race::where('session_id', $id)->first();
        $drivers = $race->drivers()->get();
        $totalVotes = Vote::where('session_id', $id)->get();

        return view('race.results', ['id' => $id, 'drivers' => $drivers, 'totalVotes' => $totalVotes->count()]);
    }

    public function links($id) {
        return view('race.links', ['id' => $id]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Race $race)
    {
        //
    }

    public function edit(Race $race)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Race $race)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Race $race)
    {
        //
    }
}
