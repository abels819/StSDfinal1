<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order_type;
use App\order;
use App\Http\Controllers\general_requests;

class ajax_requests extends Controller
{
    public function lang_array($lang){
        if($lang==null){
            $lang="ch";
        }
        $arr= [
            "ch"=>[
                "id"=>"订单号",
                "start_date"=>"起始日期",
                "end_date"=>"失效日期",
                "status"=>"订单状态",
                "type"=>"订单类型",
                "_0"=>"未生效",
                "_1"=>"有效",
                "_2"=>"过期",
                "1_E"=>"单节体验课",
                "1_G"=>"单节普通课",
                "1_P"=>"单节私教课",
                "M_G"=>"普通课月卡",
                "T_G"=>"学期卡",
        
            ],
            "en"=>[
                
                "id"=>"id",
                "start_date"=>"start date",
                "end_date"=>"expiration date",
                "status"=>"order status",
                "type"=>"order type",
                "_0"=>"not available",
                "_1"=>"available",
                "_2"=>"expired",
                "1_E"=>"experiencing",
                "1_G"=>"single general lesson",
                "1_P"=>"single personal training",
                "M_G"=>"general lessons for one month",
                "T_G"=>"general lessons for one term",
            ],
            
        ];
        return $arr[$lang];
    }
    
    public function periods(){
        $lang=session()->get("lang");
        if($lang==null){
            $lang="ch";
        }
        
        $periods= order_type::aquire_all_order_types();
        $name="name_".$lang;
        
        
        foreach ($periods as $temp){
            echo "<li><a onclick='";
            echo 'apply("period","periodopt","'.$temp->code.'")';
            echo "'>";
            echo $temp->$name." : ".$temp->price." CNY ";
            echo "</li></a>";
        }
    }
    
    public function listview($id){
        $list= order::fetch_all_of_one($id);
        foreach ($list as $temp){
            $statoforder=order::judge_duration($temp->start_date, $temp->end_date);
            $temp->status=$statoforder;
            if($statoforder==0){
                order::change_of_stat($temp->id, 0);
            }
            else if($statoforder==1){
               order::change_of_stat($temp->id, 1);
            }
            else if($statoforder==2){
               order::change_of_stat($temp->id, 2);
            }
            
        }
        $titles=$this->lang_array(session()->get("lang"));
        echo "<tr>";
        echo "<td>".$titles['id']."</td>";
        echo "<td>".$titles['start_date']."</td>";
        echo "<td>".$titles['end_date']."</td>";
        echo "<td>".$titles['status']."</td>";
        echo "<td>".$titles['type']."</td>";
        echo "</tr>";
        foreach($list as $temp){
            echo "<tr>";
            echo "<td>";
            echo $temp->id;
            echo "</td><td>";
            echo $temp->start_date;
            echo "</td><td>";
            echo $temp->end_date;
            echo "</td><td>";
            echo $titles["_".$temp->status];
            echo "</td><td>";
            echo $titles[$temp->type];
            echo "</td>";
            echo "</tr>";
        }
    }
}
