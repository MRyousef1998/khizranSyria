<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\EmailVerificationNotification;


use App\Http\Controllers\Controller;
use  App\Http\Resources\UserApiResource;
use App\Models\User;
use Illuminate\Http\Request;

use App\Providers\RouteServiceProvider;


use App\Mail\SinupEmail;

use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

  public function __construct() {
    $this->middleware('auth:api', ['except' => ['login', 'register']]);
}
/**
 * Get a JWT via given credentials.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function login(Request $request){
  
  $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|string|min:6',
    ]);
    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }
    if (! $token = auth()->guard('api')->attempt($validator->validated())) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    return $this->createNewToken($token);
}
/**
 * Register a User.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function register(Request $request) {
 
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|between:2,100',
        'mobile' => 'required',
        'email' => 'required|string|email|max:100|unique:users',
        'password' => 'required|string|min:6',
    ]);
   
    if($validator->fails()){
        return response()->json($validator->errors()->toJson(), 400);
    }
      
    $user = User::create(array_merge(
                $validator->validated(),
                ['password' => bcrypt($request->password),
                'role_id'=>1]
            ));
            $user->notify(new EmailVerificationNotification());
    return response()->json([
        'message' => 'User successfully registered',
        'user' => $user
    ], 201);
}

/**
 * Log the user out (Invalidate the token).
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function logout() {
    auth()->guard('api')->logout();
    return response()->json(['message' => 'User successfully signed out']);
}
/**
 * Refresh a token.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function refresh() {
    return $this->createNewToken(auth()->guard('api')->refresh());
}
/**
 * Get the authenticated User.
 *
 * @return \Illuminate\Http\JsonResponse
 */
public function userProfile() {
    return response()->json(auth()->guard('api')->user());
}
/**
 * Get the token array structure.
 *
 * @param  string $token
 *
 * @return \Illuminate\Http\JsonResponse
 */
protected function createNewToken($token){
    return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth()->guard('api')->factory()->getTTL() * 60,
        'user' => auth()->guard('api')->user()
    ]);
}



  //   public function register(Request $request)
  //   {
      
      
  //       $request->validate([

           
  //               'name' => ['required'],
               
  //               'mobile' => ['required'],
  //               'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
  //               'password' => ['required', 'string', 'min:8'], ]);
                
  //      $user= new User();
                
       
  //          $user-> name = $request->input('name');
  //        //  $user-> last_name= $request->input('last_name');
  //          $user-> email = $request->input('email');
  //          $user-> password = Hash::make($request->input('password'));
  //          $user->verification_code = sha1(time());
  //       $user-> mobile = $request->input('mobile');
  //       $user-> role_id =1;
  //          $user->save();
              
           
  //          $credentials =$request->only('email','password');
  //          if(Auth::attempt($credentials)){
  //                 $user=User::where(
  //                     'email',$request->input('email')

  //                 )->first();
                  
  //                 $user = Auth::user();
                  
  //                 $token=$user->createToken('api_token');
  //                 return $token;
  //         $user->api_token=$token->plainTextToken;
  //         $user->save();
         
  //        return new UserApiResource($user);
  //          if($user != null){
  //           //App\Http\Controllers\Api\MailController::sendSingupEmail($user->first_name, $user->email, $user->verification_code);
           
           
  //           $data = [
  //               'name' => $user->first_name,
  //               'verification_code' => $user->verification_code
  //           ];
  //          Mail::to($user->email)->send(new \App\Mail\SinupEmail($data));
      
         
  //          // Mail::to($user->email)->send(new SinupEmail($data));
           
           
  //           $message = [
  //               'error'=>false,
  //             'message'=>'we send code to verifiction'
  //           ];
  //           return response($message,200);
  //       }

        
  //       $message = [
  //           'error'=>true,
  //         'message'=>'some thing rong'
  //       ];
  //  return response($message,404);


           


  //          }
           
          
         
  //        // return ['token' => $token->plainTextToken];
  //         //  $user->api_token=bin2hex(openssl_random_pseudo_bytes(30));
            
     
  //           return new UserApiResource($user);

  //   }
  //   public function login(Request $request)
  //   {
  //       $request->validate([
  //           'email' => ['required'],
  //           'password' => ['required' ],
  //            ]);

  //            $userName=$request->input('email');
  //            $password=$request->input('password');
  //            $credentials =$request->only('email','password');
  //            if(Auth::attempt($credentials)){
  //                   $user=User::where(
  //                       'email',$userName

  //                   )->first();
  //                   return new UserApiResource($user);

  //            }
  //          $message = [
  //                'error'=>true,
  //              'message'=>'user not exsit'
  //            ];
  //       return response($message,404);

  //   }
}
