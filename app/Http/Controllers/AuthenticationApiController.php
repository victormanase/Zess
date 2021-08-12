<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthenticationApiController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required"
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = User::whereEmail($request->email)->first();
            return res([
                "api_token"=>$user->api_token
            ]);
        }

        return res([], false, "Authentication failed");
    }

    public function refreshToken(Request $request)
    {
        $user = $request->user();
        $user->api_token = Str::random(256);
        $user->save();

        return res([
            "api_token"=>$user->api_token
        ]);
    }

    public function userProfile(Request $request)
    {
        return res(new UserResource($request->user()));
    }
}
