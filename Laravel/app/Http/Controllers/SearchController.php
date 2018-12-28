<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Schedules;
use App\Selection;
use App\Places;
use DB;

class SearchController extends Controller
{
    public $arra = array();
    public function show(Request $request,$from_place_id,$to_place_id,$departure_time)
    {
        $FormPlaceId = DB::table('schedules')->where("from_place_id",$from_place_id)->where("departure_time",$departure_time)->get();
        $api_token = $request->get("token");
        $uaername = DB::table('users')->where("api_token",$api_token)->get();
        if (count($uaername)){
            $this->Search($FormPlaceId,$to_place_id);
            return response($this->arra,200);
        }else{
            return response(["message"=>"Unauthorized user"],401);
        }
    }

    public function store(Request $request){
        $api_token = $request->get("token");
        $username = DB::table("users")->where('api_token',$api_token)->get();

        $selection =  new Selection();
        $selection->from_place_id = $request->get("from_place_id");
        $selection->to_place_id = $request->get("to_place_id");
        $selection->schedules_id = $request->get("schedules_id");

        $validator = Validator::make($request->all(), [
            'from_place_id' => "required|regex:'^-?\d+$'|max:11",
            'to_place_id' => "required|regex:'^-?\d+$'|max:11",
            'schedules_id' => "required|regex:'^-?\d+$'|max:11",
        ]);
        if ($validator->fails()){
            return response(["message"=>"Data cannot be processed"],422);
        }else{
            $selection->save();
            return response(["message"=>"create success "],200);
        }
    }


    public function Search($FormPlaceId,$to_place_id){
        foreach ($FormPlaceId as $cc){
            $arr = array();
            array_push($arr,$cc);
            $this->Search2($cc,$arr,$to_place_id);
        }
        return $this->pl($this->arra);
    }
    public function Search2($cc,$arr,$to_place_id){
        if($cc->to_place_id == $to_place_id){
            if (count($this->arra) < 5){
                array_push($this->arra,$arr);
            }
        }
        $ofterPlace = DB::table('schedules')->where('from_place_id',$cc->to_place_id)->get();
//        var_dump($ofterPlace);
        if (count($ofterPlace)){
            foreach ($ofterPlace as $after){

                if ($after->departure_time > $cc->departure_time){
                    array_push($arr,$after);
                    return $this->Search2($after,$arr,$to_place_id);
                }
            }
        }else{
//            echo "没有什么鬼东西你就不要瞎鸡巴看了<br>";
        }
    }
    public function pl($pl_arr){
        for ($i=0;$i<count($pl_arr);$i++){
//            $tmp = $pl_arr[$i];
            for ($k=$i+1;$k<count($pl_arr);$k++){
                $arr_k = $pl_arr[$k];
                $arr_i = $pl_arr[$i];
                if (($arr_k[count($arr_k)-1]->departure_time) < ($arr_i[count($arr_i)-1])->departure_time){
                    $th = $arr_k;
                    $pl_arr[$k] = $pl_arr[$i];
                    $pl_arr[$i] = $th;
                }
            }
        }
        return $pl_arr;
    }
}
