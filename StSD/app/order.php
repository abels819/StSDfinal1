<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class order extends Model {

    var $ID;
    var $start_date;
    var $end_date;
    var $status;
    var $type;
    var $student;

    public static function fetch_all_of_one($id) {
        return DB::table("orders")->where(["studentid" => $id])->orderby("id", "desc")->get();
    }

    public static function fetch_all_by_IDnumber($id) {
        return DB::table("student")->leftjoin("orders", "orders.studentid", "=", "student.id")->where(["lisence" => $id])->get();
    }

    public static function fetch_available_courses($id) {
        return DB::table("student")->leftjoin("student", "orders.studentid", "=", "student.id")->where(["lisence" => $id, "status" => "1"]);
    }

    private static function start_of_count_down($date1, $date2) {//param 2 is later or nagitive
        //echo "...counting...";
        $stat = 1;
        $result = array();
        for ($i = 0; $i < 3; $i++) {
            if ($date1[$i] == $date2[$i]) {
                array_push($result, 1);
                $stat=1;
            } else if ($date1[$i] < $date2[$i]) {
                array_push($result, 2);
                $stat=2;
            } else {
                array_push($result, 0);
                $stat=0;
            }
            //echo $stat . ",";
        }
        //echo ";";
        foreach ($result as $temp) {
            if ($temp == 0) {
                return 0;
            } 
            if($temp==2){
                return 1;
            }
        }
        return 1;
    }

    public static function judge_duration($startdate, $enddate) {
        $stat;
        $today = explode("-", date("Y-m-d"));
        $startdate = explode("-", $startdate);
        $enddate = explode("-", $enddate);
        $date1 = $startdate;
        $date2 = $enddate;
        //echo $date1[0] . "-" . $date1[1] . "-" . $date1[2] . "," . $date2[0] . "-" . $date2[1] . "-" . $date2[2] . ",";
        $started = self::start_of_count_down($startdate, $today);
        if ($started == 0) {
            $stat = 0;
        } else {
            $expired = self::start_of_count_down($today, $enddate);
            if ($expired == 0) {
                $stat = 2;
            } else {
                $stat = 1;
            }
        }
        //echo $stat;
        //echo "<br/>";
        return $stat;
    }

    public static function create_order($stuid, $start_date, $end_date, $type, $paystat) {
        DB::table("orders")->insert(["studentid" => $stuid, "start_date" => $start_date, "end_date" => $end_date, "type" => $type, "paystatus" => $paystat]);
    }

    public static function change_of_stat($orderid, $status) {
        //echo $status;
        DB::table("orders")->where(["id" => $orderid])->update(["status" => $status]);
    }

}
