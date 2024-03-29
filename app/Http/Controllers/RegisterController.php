<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Tymon\JWTAuth\JWTAuth;

class RegisterController extends Controller
{
    /**
     * @var Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }
    
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [
            'first_name' => 'required|alpha|min:2|max:255',
            'last_name' => 'required|alpha|min:2|max:255',
            'mobile' => 'required|digits:11',
            'gender' => 'required',
            'birthday' => 'required|date_format:Y-m-d|before:today|nullable',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

       try {
  
            $user=User::create([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'mobile' => $request->input('mobile'),
                'gender' => $request->input('gender'),
                'birthday' => $request->input('birthday'),
                'email' => $request->input('email'),
                'password' => app('hash')->make($request->input('password'))
            ]);
                   
            //return successful response
            return response()->json([
                'status'=>true,
                'code'=>200,
                'user' => $user,
                 'message' => 'User CREATED'
            ], 201);

        } catch (\Exception $e) {
            //return error message
             return response()->json([
                'status'=>false,
                'code'=>404,
                'message' => 'User Registration Failed!'
            ], 409);
        }

    }

     /**
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
          //validate incoming request 
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);
        if (! $token = Auth::attempt($credentials)) {
            return response()->json([
                'status'=>false,
                'code'=>404,
                'message' => 'email or password are invalid'
            ], 401);
        }
        $user = Auth::user();
        $user->token=$token;
        $user->token_type = 'bearer';
        $user->expires_in = Auth::factory()->getTTL() * 600;
        $data=array(
            'status'=>true,
            'code'=>200,
            'message'=>'login successfully',
            'userData'=>$user);

        return response()->json( $data);
    }

    public function logout(Request $request)
    {
        $token =  str_replace('Bearer ','',$request->header('Authorization'));
        $this->jwt->setToken($token)->invalidate();
        $this->jwt->setToken($token)->invalidate(true);
        Auth::logout();
        $this->jwt->invalidate($this->jwt->getToken());
        $this->jwt->parseToken()->invalidate();
        return response()->json([
            'status'=>true,
            'code'=>200,
            'message'=>'Successfully logged out'
        ]);
         
    }


}
