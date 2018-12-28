<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedules;
use DB;
class cf
{
    public $aa = Array();
    //递归
    public function Search($FormPlaceId,$arr){
        foreach ($FormPlaceId as $cc){
            $aa = array();
            $this->Search2($cc,$aa,$arr);
        }
    }
    public function Search2($cc,$aa,$arr){
        $ofterPlace = DB::table('schedules')->where('from_place_id',$cc->to_place_id)->get();
        if (count($ofterPlace)){
            foreach ($ofterPlace as $after){
                if ($after->departure_time > $after->departure_time){
                    return $this->searchPlaceId($cc,$aa,$arr);
                }
            }
        }else{
            echo "没有什么鬼东西你就不要瞎鸡巴看了";
        }
    }
}