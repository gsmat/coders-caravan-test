<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ]);
        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            $token = $user->createToken('token')->plainTextToken;

            return response()->json([
                'data' => [
                    'token' => $token,
                    'user_id' => $user->id
                ],
                'status' => true
            ]);
        }


    }

    public function register(Request $request)
    {
        //mvc
        /*$request->validate([
            'name' => ['required', 'string', 'min:3'],
            'surname' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
            'password_confirmation' => ['required', 'same:password']
        ]);

        return 'ok';*/

        //['data' => '', 'status' =>true]

        //['error' => '', 'status' =>false]

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3'],
            'surname' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:6'],
            'password_confirmation' => ['required', 'same:password']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ]);
        }

        try {
            $new_user = new User();
            $new_user->name = $request->name;
            $new_user->email = $request->name;
            $new_user->password = Hash::make($request->name);
            $new_user->role = 'user';
            $new_user->save();

            return response()->json([
                'data' => [],
                'status' => true
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}
