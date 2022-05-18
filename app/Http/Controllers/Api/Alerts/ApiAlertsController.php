<?php

namespace App\Http\Controllers\Api\Alerts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiAlertsController extends Controller

{


    public function getAlerts(){
        $userId = request('userId');
        
        return DB::table('alerts')
        ->where('userId','=', $userId)
        ->get();
    }

    public function createAlert(){
        $userId = request('userId');
        $condition = request('condition');
        echo $userId;
        echo $condition;

        return DB::table('alerts')
        ->insert([
            'userId' => $userId,
            'stationId' => 1,
            'condition' => $condition,
        ]);

    }
}