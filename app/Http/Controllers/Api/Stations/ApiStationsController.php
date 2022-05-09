<?php

namespace App\Http\Controllers\Api\Stations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Resources\Station as StationResources;
use App\Models\Station;

class ApiStationsController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function stationsByUserId()
    {
        $id = request('id');
        $stations = DB::table('stations')
        ->where('ownerId', '=', $id)
        ->get();
        return $stations;
    }
}