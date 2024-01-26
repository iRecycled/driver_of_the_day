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
        $session = Cache::get('league_session_'.$id);
        return view('race.vote', ['session' => $session, 'season', 'id' => $id]);
    }

    public function results($id) {
        $drivers = Driver::with(['votes' => function ($query) use ($id) {
            $query->where('session_id', $id);
        }])->get();
        $totalVotes = Vote::where('session_id', $id)->count();

        return view('race.results', ['id' => $id, 'drivers' => $drivers, 'totalVotes' => $totalVotes]);
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
