<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
        return view('race.vote', ['session' => $session, 'id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Race $race)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
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
