<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $alreadyExist = User::where('email', $request->email)->first();

        if ($alreadyExist) {
            return response()->json(['error' => 'Email already exist'], 409);
        }


        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
           
            $token = $user->createToken(env('AUTH_TOKEN'))->accessToken;
     
            return response()->json(['token' => $token], 200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken(env('AUTH_TOKEN'))->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Invalid Credentials'], 401);
        }
    }   
}
