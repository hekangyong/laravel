<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LogoutController extends Controller
{
    public function index(Request $request){
        $api_token = $request->get("token");
        $api_tokena =DB::table("users")->where("api_token",$api_token)->get();
        if (count($api_tokena)){
            $affected =DB::table("users")->where("api_token",$api_token)->update(["api_token"=>""]);
            return response(["message"=>"logout success"],200);
        }else{
            return response(["message"=>"Unauthorized user"],401);
        }
    }

    public function show(){

    }
}