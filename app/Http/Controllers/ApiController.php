<?php

namespace App\Http\Controllers;
use iRacingPHP\iRacing;

class ApiController extends Controller
{
    public function auth() {
        return new iRacing(env('IRACING_EMAIL'), env('IRACING_PASSWORD'), env('IRACING_COOKIE_PATH'));
    }

    public function getLeagueZeroRoster() {
        $auth = $this->auth();
        $league = $auth->league->get(4534);
        $drivers = $league->roster;

        $driversData = [];
        foreach ($drivers as $driver) {
            $driversData[] = [
                'name' => $driver->display_name,
                'number' => $driver->car_number
            ];
        }
        return $driversData;
    }
}
