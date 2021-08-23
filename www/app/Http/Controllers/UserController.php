<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return User::all();
    }

    public function store(Request $request){
        $validatedData = $this->validate($request,
            [
                "name" => "required|max:255",
                'email' => 'required|max:255|email|unique:users,email',
                "password" => "required"
            ]
        );
        $validatedData['password'] = \Hash::createBcryptDriver()->make($validatedData['password']);

        $user = User::create($validatedData);
        $user->refresh();
        return $user;
    }

    public function update(Request $request,$id){
        $user = User::findOrFail($id);

        $validatedData = $this->validate($request,[
            "name" => "max:255",
            "password"=>"required",
            "new_password"=>"max:255",
            "confirm_new_password"=>"same:new_password"
        ]);

        if(!\Hash::check($validatedData["password"],$user->password)){
            return response()->json(["message"=>"Invalid Credentials"],401);
        }

        $validatedData['password'] = $user->updatePassword($validatedData['new_password'] ?? null);

        $user->update($validatedData);
        $user->refresh();
        return $user;
    }

    public function show($id){
        return User::findOrFail($id);
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        return response()->noContent();
    }


}
