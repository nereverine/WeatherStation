<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function currentUser(Request $request)
    {
        //return $request->user();
        return new UserResource($request->user());
         //Alternative:*return Auth::user();
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    
}
