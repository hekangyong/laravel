<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Schedules;
use Validator;

class SchedulesController extends Controller
{
    public function store(Request $request){
        $schedules = new Schedules();
        $schedules->type = $request->get("type");
        $schedules->line = $request->get("line");
        $schedules->from_place_id = $request->get("from_place_id");
        $schedules->to_place_id = $request->get("to_place_id");
        $schedules->departure_time = $request->get("departure_time");
        $schedules->arrival_time = $request->get("arrival_time");
        $schedules->distance = $request->get("distance");
        $schedules->speed = $request->get("speed");
        $schedules->status = $request->get("status");
//        $schedules->save();

        $api_token = $request ->get('token');
        $namne = DB::table('users')->where("api_token",$api_token)->get();
        if (count($namne)){
            foreach ($namne as $i){
                if ($i->username === 'admin'){
                    $schedules->save();
                    return response(["message"=>"create success"],200);
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
                    Schedules::find($id)->delete();
                    return response(["message"=>"delete success"],200);
                }else{
                    return response(["message"=>"Unauthorized user"],401);
                }
            }
        }else{
            return response(["message"=>"Data cannot be deleted"],400);
        }
    }
}
