<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;



class UserController extends Controller
{
  // Get user by id
  public function show(Request $request, $id)
  {
    try {
      $user = User::find($id);
    } catch (Exception $e) {
      return response()->json([
        'status' => 'error',
        'errors' => $e->getMessage()
      ], 422);
    }
    return response()->json(
      [
        'status' => 'success',
        'user' => $user->toArray()
      ],
      200
    );
  }
}
