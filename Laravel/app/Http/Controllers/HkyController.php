<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HkyController extends Controller
{
    public function store(Request $request){
        $username = $request->get("username");
        $password = $request->get("password");
        $usernamnea = DB::table('users')->where('username',$username)->where("password",md5($password))->get();
        if(count($usernamnea)){
            $role="";
            foreach ($usernamnea as $i) {
                if ($i->username === "admin") {
                    $role = "admin";
                } else {
                    $role = "user";
                }
                $api_tokena = DB::table('users')->where('username', $username)->update(["api_token" => md5($username)]);
            }
            return response(["message"=>"login success"],200);
        }
        else{
            return response(["message"=>"invalid login"],401);
        }
    }
}
