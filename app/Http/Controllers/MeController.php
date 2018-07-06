<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;

class MeController extends Controller
{
    public function Me(Request $request){
      
      $user = JWTAuth::toUser( $request->bearerToken() );
      
      return response()->json(
        [
          'result' => [
            'user' => $user
          ]
        ]
      );
      
    }
}
