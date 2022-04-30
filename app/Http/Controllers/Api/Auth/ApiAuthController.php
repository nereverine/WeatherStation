<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
//use App\Http\Resources\User as UserResource;

use App\Models\User;

class ApiAuthController extends Controller
{
    public function login(Request $request){

        $credentials = $request->only('email', 'password'); 
        
            
        if (Auth::attempt($credentials)){            
            //return new UserResource(Auth::user());
            return Auth::user();
        } else {
            echo($request);            
            return response()->json(['message' => 'Unauthenticated'], 401);
         }
       
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        return response()->json(['msg' => 'User session closed'], 200);
    }

}