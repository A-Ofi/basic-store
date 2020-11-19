<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserForm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Helium\Jwt\Tokenizer;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * response with token wrttien to Authorization header
     */
    private function responseWithAuthorization($token, $message){
        return
            response($message)
                ->withHeaders([
                    "authentication_token" => $token
                ]);
    }

    function signup(UserForm $request){
        
        $user = new User();
        $user->fill($request->validated());
        $user->save();
        
        $claims = $request->only("email");
        $claims['role'] = "User";
        $token = Tokenizer::encode($claims);
        return $this->responseWithAuthorization($token, ['User Created']);
    }

    function signin(Request $request){
        $credentials = $request->only("email", "password");
        if(Auth::attempt($credentials)){
            $claims = $request->only("email");
            $token = Tokenizer::encode($claims);
            return $this->responseWithAuthorization($token, ['Authentication Succed']);
        }
        return response(["login failed"], 401);
    }

    function signout(Request $request){
        DB::table("token_black_list")
            ->insert([
                "token" => $request->header('Authorization')
            ]);
        return response(['signed out']);
    }

}
