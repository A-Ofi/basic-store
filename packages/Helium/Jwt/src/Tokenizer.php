<?php

namespace Helium\Jwt;

use Exception;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\DB;

class Tokenizer{

    private static $TIME = 31540000;

    public static function encode(Array $data){
        $data["exp"] = time() + self::$TIME; 
        $token =  JWT::encode($data, env('HASHKEY'));
        return $token;
    }

    public static function decode($token){
        $blacklisted = DB::table('token_black_list')
            ->where('token',$token)
                ->exists();

        if($blacklisted){
            return ;
        }
        
        try{
            $payload = JWT::decode($token, env('HASHKEY'), array('HS256'));
            return $payload;
        }catch(Exception $e){
            return ;
        }
        
    }
}

?>