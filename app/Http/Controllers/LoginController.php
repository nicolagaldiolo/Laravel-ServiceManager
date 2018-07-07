<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));

    }

    /*
      public function login(Request $request)
      {

        $credentials = $request->only('email', 'password');
        $token = null;
        if (!$token = JWTAuth::attempt($credentials)) {
          return response()->json([
              'result' => [
                  'response' => 'error',
                  'message' => 'invalid_credentials'
              ]
          ]);
        }

          return response()->json([
              'result' => [
                  'response' => 'success',
                  'token' => $token
              ]
          ]);

      }*/
    }
