<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

trait TraitEmitToken {

    public function emitToken(Request $request, $grantType, $scope = "*"){

        $param = [
            'grant_type' => $grantType,
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'username'=> $request->username ?: $request->email,
            'scope' => $scope
        ];

        $request->request->add($param);

        $proxy = Request::create('oauth/token', 'POST');

        return Route::dispatch($proxy);

    }
}
