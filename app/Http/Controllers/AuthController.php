<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{

  public function register(Request $request)
  {
    // validate form
    $v = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required|email|unique:users',
      'password'  => 'required|min:8|confirmed',
    ]);

    // Validation error
    if ($v->fails()) {
      return response()->json([
        'status' => 'error',
        'errors' => $v->errors()
      ], 422);
    }

    try {
      // Create user
      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = bcrypt($request->password);
      $user->save();
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'errors' => $e->getMessage()
      ], 422);
    }
    // Return success
    return response()->json(['status' => 'success'], 200);
  }

  public function login(Request $request)
  {
    // Validate form
    $v = Validator::make($request->all(), [
      'email' => 'required|email',
      'password'  => 'required',
    ]);

    // Validation error
    if ($v->fails()) {
      return response()->json([
        'status' => 'error',
        'errors' => $v->errors()
      ], 422);
    }
    // get credentials
    $credentials = $request->only('email', 'password');

    // valid credentials
    if ($token = $this->guard()->attempt($credentials)) {
      return response()->json(['status' => 'success'], 200)->header('Authorization', $token);
    }

    // Return error
    return response()->json(['error' => 'login_error'], 401);
  }


  // Logout
  public function logout()
  {
    try {
      $this->guard()->logout();
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'errors' => $e->getMessage()
      ], 422);
    }

    // return success
    return response()->json([
      'status' => 'success',
      'msg' => 'Logged out Successfully.'
    ], 200);
  }


  // Get user by id
  public function user(Request $request)
  {
    try {
      $user = User::find(Auth::user()->id);
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'errors' => $e->getMessage()
      ], 422);
    }
    return response()->json([
      'status' => 'success',
      'data' => $user
    ]);
  }

  // Refresh token
  public function refresh()
  {
    if ($token = $this->guard()->refresh()) {
      return response()
        ->json(['status' => 'successs'], 200)
        ->header('Authorization', $token);
    }
    // return error
    return response()->json(['error' => 'refresh_token_error'], 401);
  }

  // Authentication guard
  private function guard()
  {
    return Auth::guard();
  }
}
