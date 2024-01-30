<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\Vote;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use chillerlan\QRCode\QRCode;

class RaceController extends Controller
{
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
        $QRurl = url('/race/vote/' . $id);
        $url = url('/race/qr/'. $id);
        $qr = (new QRCode)->render($QRurl);
        return view('race.links', ['id' => $id, 'qr' => $qr, 'url' => $url]);
    }

    public function showQR($id) {
        $url = url('/race/vote/' . $id);
        $qr = (new QRCode)->render($url);
        return view('race.qr', ['qr' => $qr]);
    }

    public function showDOTD($id) {
        $race = Race::where('session_id', $id)->first();
        $drivers = $race->drivers()->get();
        $top3 = $drivers->sortByDesc(function ($driver) {
            return $driver->votes()->count();
        })->take(3);
        $top3col = collect($top3, Driver::class);
        $totalVotes = Vote::where('session_id', $id)->get();
        return view('race.dotd', ['drivers' => $top3col, 'totalVotes' => $totalVotes]);
    }
}
