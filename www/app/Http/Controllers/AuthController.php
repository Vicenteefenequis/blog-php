<?php

namespace App\Http\Controllers;

use Auth;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {

    public function authenticate(Request $request) {
        $credentials = $this->validate($request, [
            "email" => "required|email",
            "password" => "required"
        ]);

        $user = \App\Models\User::where("email", $credentials["email"])->first();

        if (!$user || !Hash::check($credentials["password"], $user->password)) {
            return response()->json(["message" => "Credenciais invalidas"], 401);
        }

        $token = $user->createToken("blog_api")->plainTextToken;

        return response()->json(["user" => $user, "token" => $token]);


    }

}
