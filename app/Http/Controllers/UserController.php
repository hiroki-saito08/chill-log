<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function show()
  {
    return response()->json(Auth::user());
  }

  public function update(Request $request)
  {
    $user = Auth::user();
    $data = $request->validate([
      'name' => 'sometimes|string|max:255',
      'email' => 'sometimes|email|unique:users,email,' . $user->id,
      'password' => 'sometimes|string|min:8|confirmed'
    ]);

    if (isset($data['password'])) {
      $data['password'] = bcrypt($data['password']);
    }

    $user->update($data);

    return response()->json($user);
  }
}
