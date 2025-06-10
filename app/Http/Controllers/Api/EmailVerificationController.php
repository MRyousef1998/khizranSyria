<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  App\Http\Requests\Auth\EmailVerificationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

use Otp;

class EmailVerificationController extends Controller
{
    private $otp;
public function __construct(){
$this->otp=new Otp;

}
  public function email_verification(EmailVerificationRequest $request){
    $validator = Validator::make($request->all(), [
      
      'email' => 'required|string|email|max:100|exists:users',
      'otp' => 'required|string|min:5',
  ]);
 
  if($validator->fails()){
      return response()->json($validator->errors()->toJson(), 400);
  }

    $otp2=$this->otp->validate($request->email,$request->otp);
    if(!$otp2->status){
      $success['success']=false;
      return response()->json($success,200);
    }
    $user=User::where('email',$request->email)->first();
    $user->update(["email_verified"=>1]);
    $success['success']=true;
    return response()->json($success,200);
    



  }
}
