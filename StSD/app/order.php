<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class order extends Model
{
    var $ID;
    var $start_date;
    var $end_date;
    var $status;
    var $type;
    var $student;
    public static function fetch_all_of_one($id){
        return DB::table("orders")->where(["studentid"=>$id])->orderby("id","desc")->get();
    }
    
    public static function fetch_all_by_IDnumber($id){
        return DB::table("student")->leftjoin("orders","orders.studentid","=","student.id")->where(["lisence"=>$id])->get();
    }
    public static  function fetch_available_courses($id){
        return DB::table("student")->leftjoin("student","orders.studentid","=","student.id")->where(["lisence"=>$id,"status"=>"1"]);
    }
    
    private static function start_of_count_down($date1,$date2){//param 2 is later or nagitive
        $stat=0;
        
        for($i=0;$i<3;$i++){
            if($date2[$i]>$date1[$i]){
                $stat=1;
                break;
            }
        }
        return $stat;
    }
    
    public static function judge_duration($startdate,$enddate){
        $stat;
        $today=explode("-",date("Y-m-d"));
        $startdate= explode("-", $startdate);
        $enddate= explode("-", $enddate);
        $started=self::start_of_count_down($startdate, $today);
        if($started==0){
            $stat=0;
        }
        else{
            $expired=self::start_of_count_down( $enddate,$today);
            if($expired==1){
                $stat=2;
            }
            else{
                $stat=1;
            }
        }
        return $stat;
    }
    public static function create_order($stuid,$start_date,$end_date,$type,$paystat){
        DB::table("orders")->insert(["studentid"=>$stuid,"start_date"=>$start_date,"end_date"=>$end_date,"type"=>$type,"paystatus"=>$paystat]);
    }
    
    public static function change_of_stat($orderid,$status){
        //echo $status;
        DB::table("orders")->where(["id"=>$orderid])->update(["status"=>$status]);
    }
}
