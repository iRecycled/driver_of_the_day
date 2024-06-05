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
        $race = Race::where('session_id', $id)->first();
        return view('race.vote', ['race' => $race]);
    }

    public function results($id) {
        $race = Race::where('session_id', $id)->with('drivers.votes')->first();
        $drivers = $race->drivers()->get();
        return view('race.results', ['id' => $id, 'drivers' => $drivers, 'race' => $race]);
    }

    public function links($id) {
        $QRurl = url('/race/vote/' . $id);
        $url = url('/race/qr/'. $id);
        $qr = (new QRCode)->render($QRurl);
        $dotdUrl = url('/race/dotd/'. $id);
        return view('race.links', ['id' => $id, 'qr' => $qr, 'url' => $url, 'dotdUrl' => $dotdUrl]);
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
            return $driver->votes->count();
        })->take(3);
        $top3col = collect($top3, Driver::class);
        $totalVotes = $race->getTotalVotes();
        return view('race.dotd', ['drivers' => $top3col, 'totalVotes' => $totalVotes, 'race' => $race, 'id' => $id]);
    }

    public function resultsAPI($id) {
        $retDriversA = [];

        $race = Race::where('session_id', $id)->with('drivers.votes')->first();

        if ($race) {
            $dbDrivers = $race->drivers()->get();
            $totalVotes = $race->getTotalVotes();


            $dbDrivers->each(function ($driver) use (&$retDriversA, &$totalVotes, &$race) {
                $driverVotes = $driver->getDriverVotes($race->id);
                array_push($retDriversA, [
                    'name' => $driver->name,
                    'percentage' => ($totalVotes > 0) ? $driverVotes / $totalVotes : -1,
                    'votes' => ($totalVotes > 0) ? $driverVotes : -1
                ]);
            });
        }

        return ['data' => ['drivers' => $retDriversA, 'subsession' => $id]];
    }
}
