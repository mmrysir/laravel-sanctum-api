<?php

namespace App\Http\Controllers;
use App\Models\User;
use http\Message;
use Illuminate\Http\Request;
use  Illuminate\Support\Facades\Hash;
use  Illuminate\Http\Response;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    public function register(Request $request)
    {

        $fields = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],

            ]);

            $user = User::create([
                'name' => $fields['name'],
                'email' => $fields['email'],
                'password' => bcrypt($fields['password']),
            ]);

            $token = $user->createToken('myapptoken')->plainTextToken;
            $response =[
                'user'=>$user,
                'token'=>$token
            ];
            return $response($response, 201);


    }
}
