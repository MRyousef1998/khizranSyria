<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class ResetPasswordController extends Controller
{
  public function reset_password(Request $request){

    $validator = Validator::make($request->all(), [
        'email' => 'required|string|email|max:100|exists:users',
        'password' => 'required|string|min:6',
    ]);
   
    if($validator->fails()){
        return response()->json($validator->errors()->toJson(), 400);
    }
    $user = User::where('email','=',$request->email)->first();
    $user->update(['password' => bcrypt($request->password)]);
  return  response()->json([
        'message' => 'password changed successfully',
       'user'=>$user,
    ], 201);
  }
}
