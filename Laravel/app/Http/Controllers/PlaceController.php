<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Places;

class PlaceController extends Controller
{
    public function index(Request $request){
        $api_token = $request->get("token");
        $namne = DB::table('users')->where("api_token",$api_token)->get();
//        return $api_token;
        if (count($namne)){
            foreach ($namne as $i) {
                if ($i->username === "admin") {
                    $role = "admin";
                    $namnea = DB::table('places')->get();
                    return response([$namnea],200);
                } else {
                    $role = "user";
                    return response(["message"=>"Unauthorized user"],401);
                }
            }
        }else{
            return response(["message"=>"Unauthorized user"],401);
        }
    }

    public function show(Request $request, $id){
        $name = DB::table('places')->where("id",$id)->get();
        return($name);
        $api_token = $request->get("token");
        $uaername = DB::table('users')->where("api_token",$api_token)->get();
        if (count($uaername)){
            if (count($name)){
                return response([$name],200);
            } else {
                return response(["message"=>"not"],401);
            }
        } else {
            return response(["message"=>"noot"],401);
        }
    }

    public function store(Request $request){
        $places = new Places();
        $places->name = $request->get("name");
        $places->latitude = $request->get("latitude");
        $places->longitude = $request->get("longitude");
        $places->x = $request->get("x");
        $places->y = $request->get("y");
        $places->image_path = $request->get("image_path");
        $places->description = $request->get("description");

        $validator = Validator::make($request->all(), [
            'name' => "required|string|max:100",
            'image_path' => "required|string|max:50",
            'latitude' => "required|regex:'^(-?\d+)(\.\d+)?$'|max:8",
            'longitude' => "required|regex:'^(-?\d+)(\.\d+)?$'|max:8",
            'x' => "required|regex:'^-?\d+$'|max:11",
            'y' => "required|regex:'^-?\d+$'|max:11",
            'description' => "required|string"
        ]);
        if ($validator->fails()) {
            return response(["message"=>"Data cannot be processed"],422);
        }

        $api_token = $request ->get('token');
        $namne = DB::table('users')->where("api_token",$api_token)->get();
        if (count($namne)){
            foreach ($namne as $i){
                if ($i->username === 'admin') {
                    $places->save();
                    return response(["message" => "create success "], 200);
                }
            }
        }else{
            return response(["message"=>"Unauthorized user  "],401);
        }
    }

    public function destroy(Request $request, $id){
        $api_token = $request ->get('token');
        $namne = DB::table('users')->where("api_token",$api_token)->get();
        if (count($namne)){
            foreach ($namne as $i){
                if ($i->username === 'admin'){
                    Places::find($id)->delete();
                    return response(["message"=>"delete success"],200);
                }else{
                    return response(["message"=>"Unauthorized user  "],401);
                }
            }
        }else{
            return response(["message"=>"Data cannot be deleted"],400);
        }
    }
}