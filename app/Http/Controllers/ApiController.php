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

        $htmlTable = '
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                font-size: 18px;
                text-align: left;
            }
            th, td {
                padding: 12px;
                border-bottom: 1px solid #ddd;
            }
            th {
                background-color: #f2f2f2;
            }
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }
            tr:hover {
                background-color: #f1f1f1;
            }
        </style>
        <table>
            <tr>
                <th>Name</th>
                <th>Number</th>
            </tr>';

        foreach ($driversData as $data) {
            $htmlTable .= '<tr>';
            $htmlTable .= '<td>' . htmlspecialchars($data['name']) . '</td>';
            $htmlTable .= '<td>' . htmlspecialchars($data['number']) . '</td>';
            $htmlTable .= '</tr>';
        }
        $htmlTable .= '</table>';
        return $htmlTable;
    }
}