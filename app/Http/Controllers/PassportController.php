<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class PassportController extends Controller
{
  public function register(Request $request)
  {
      $this->validate($request, [
          'name' => 'required|min:4',
          'email' => 'required|email',
          'password' => 'required|min:8',
      ]);

      $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => bcrypt($request->password)
      ]);

      $token = $user->createToken('Laravel8PassportAuth')->accessToken;

      return response()->json(['token' => $token], 200);
  }
    public function login(Request $request){
      $login = $request->validate([
        'email' => 'required',
        'password' => 'required'
      ]);
      if(! Auth::attempt($login)){
        $msg = 'Invalid credential';
        return response()->json($msg);
      }
      $accessToken = Auth::user()->createToken('accessToken')->accessToken;
      return response()->json([
        'user' => Auth::user(),
        'access_token' => $accessToken
      ]);
    }
    public function users() {
      $users = User::all();
      return response()->json($users);
    }
    public function userInfo()
    {

     $user = auth()->user();
     return response()->json(['user' => $user], 200);

    }
}
