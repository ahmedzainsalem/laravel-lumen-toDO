<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\User;

class RegisterController extends Controller
{
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
            return response()->json(['user' => $user, 'message' => 'User CREATED'], 201);

        } catch (\Exception $e) {
            //return error message
             return response()->json(['message' => 'User Registration Failed!'], 409);
        }

    }


}
