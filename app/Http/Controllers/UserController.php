<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use  App\User;

class UserController extends Controller
{
     /**
     * Instantiate a new UserController instance.
     *
     * @return void
     */
    public function __construct()
    {
         $this->middleware('auth');
    }
    /**
     * Get the authenticated User.
     *
     * @return Response
     */
    public function profile()
    {
        return response()->json([
            'status'=>true,
            'code'=>200,
            'user' => Auth::user()
        ], 200);
    }
    /**
     * Get all User.
     *
     * @return Response
     */
    public function allUsers()
    {
         return response()->json([
            'status'=>true,
            'code'=>200,
            'users' =>  User::paginate(5)
        ], 200);
    }
    /**
     * Get one user.
     *
     * @return Response
     */
    public function singleUser($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json([
                'status'=>true,
                'code'=>200,
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'=>false,
                'code'=>404,
                'message' => 'user not found!'
            ], 404);
        }
    }
}

?>