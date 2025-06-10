<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\EmailVerificationNotification;


use  App\Http\Resources\UserApiResource;


use App\Providers\RouteServiceProvider;


use App\Mail\SinupEmail;



class ChekEmailController extends Controller
{
    public function email_check(Request $request){
      
      
        $validator = Validator::make($request->all(), [
          
          'email' => 'required|string|email|max:100|exists:users',
         
      ]);
     
      if($validator->fails()){
          return response()->json($validator->errors()->toJson(), 400);
      }
   
    
     $user = User::where('email','=',$request->email)->first();
     $user->notify(new EmailVerificationNotification());
     return response()->json([
         'message' => 'email is exists',
       
     ], 201);
    
        
    
    
    
      }
}
