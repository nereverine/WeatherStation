<?php

namespace App\Http\Controllers\Api\Sensors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiSensorsController extends Controller

{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function sensorsByStation()
    {
        $stationId = request('id');
        $sensors = DB::table('stationsensors')
        ->select('sensorId')
        ->where('stationId', '=', $stationId)
        ->get();
        return $sensors;
    }

    public function sensorById()
    {
        $id = request('id');
        $sensor = DB::table('sensors')
        ->where('id', '=', $id)
        ->get();
        return $sensor;
    }
}