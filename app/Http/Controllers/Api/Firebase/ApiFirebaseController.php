<?php

namespace App\Http\Controllers\Api\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Kreait\Firebase;
use Kreait\Firebase\Factory;

class ApiFirebaseController extends Controller

{
    private $database;

    public function __construct(){
        $this->database = $this->connect();
    }
    public static function connect()
    {
        $firebase = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->withDatabaseUri(env("FIREBASE_DATABASE_URL"));

        return $firebase->createDatabase();
    }

    public function getYears() 
    {
    $path = "/";
    return response()->json($this->database->getReference($path)->getValue());
    }

    public function todaysData(){
        //$year = request('year');
        //$month = request('month');
        //$day = request('day');
        $path = request('path');
        return response()->json($this->database->getReference($path)->getValue());
        
    }


}