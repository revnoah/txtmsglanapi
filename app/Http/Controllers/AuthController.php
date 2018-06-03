<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
  public function register(Request $request)
  {
    //check to see if user exists first
    $existingUser = User::where(
      'email', '=', $request->email
    )->first();

    //handle response for existing user
    if($existingUser != null) {
      return response()->json([
        'error' => 'Account Exists',
        'message' => 'Try logging in'
      ], 401);
    } else {
      $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
      ]);

      $token = auth()->login($user);

      return $this->respondWithToken($token);
    }
  }

  public function login(Request $request)
  {
    $credentials = $request->only(['email', 'password']);

    if (!$token = auth()->attempt($credentials)) {
      return response()->json(['error' => 'Unauthorized'], 401);
    }

    return $this->respondWithToken($token);
  }

  protected function respondWithToken($token)
  {
    return response()->json([
      'access_token' => $token,
      'token_type' => 'bearer',
      'expires_in' => auth()->factory()->getTTL() * 60
    ]);
  }

  //https://github.com/tymondesigns/jwt-auth/wiki/Creating-Tokens
  public function authenticate(Request $request)
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

}
