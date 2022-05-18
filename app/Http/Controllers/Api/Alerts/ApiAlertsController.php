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
}