<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order_type;
use App\order;
use App\Http\Controllers\general_requests;
use App\student;

class ajax_requests extends Controller
{
    public function lang_array($lang){
        if($lang==null){
            $lang="ch";
        }
        $arr= [
            "ch"=>[
                "aboutSt"=>"关于St国际",
                "aboutStSd"=>"关于St防卫联盟",
                "muayboran"=>"古泰拳",
                "silat"=>"Silat",
                "ninjutkai"=>"忍术",
                "jiujutsu"=>"古柔术",
                "mix"=>"综合防身应用",
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
                "signup"=>"购买课程",
        
            ],
            "en"=>[
                
                "aboutSt"=>"about St",
                "aboutStSd"=>"about StSd",
                "muayboran"=>"about muay boran",
                "silat"=>"about silat",
                "ninjutkai"=>"about ninjutkai",
                "jiujutsu"=>"about jiujutsu",
                "mix"=>"about customised self defense",
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
                "signup"=>"signup",
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
    public function makelink($url,$name){
        
        echo '<div class="form">';
        echo "<a class='btn btn-warning btn-lg' style='width: 97%' href=".$url.">".$name."</a>";
        echo '</div>';
    }
    
    
    public function showhidebutton($target,$name){
        echo '<div class="form">';
        echo "<a class='btn btn-success btn-lg' style='width: 97%' onclick='showhide(";
        echo '"'.$target.'"';
        echo ")'>".$name."</a>";
        echo '</div>';
    }
    public function articlearea($id,$content,$defaltshowhide){
        echo "<div class='frontpage' id='".$id."' style='display:".$defaltshowhide."'>";
        echo $content;
        echo "</div>";
    }
    
    public function article(){
        $lang=session()->get("lang");
        if($lang==null){
            $lang="ch";
        }
        $titles= $this->lang_array($lang);
        $article=student::article($lang);
        $this->showhidebutton("aboutSt",$titles["aboutSt"]);
        $this->articlearea("aboutSt",$article->St,"none");
        $this->showhidebutton("StSd",$titles["aboutStSd"]);
        $this->articlearea("StSd",$article->StSd,"none");
        $this->showhidebutton("muayboran",$titles["muayboran"]);
        $this->articlearea("muayboran",$article->muayboran,"none");
        $this->showhidebutton("silat",$titles["silat"]);
        $this->articlearea("silat",$article->silat,"none");
        $this->showhidebutton("ninjutkai",$titles["ninjutkai"]);
        $this->articlearea("ninjutkai",$article->ninjutkai,"none");
        $this->showhidebutton("jiujutsu",$titles["jiujutsu"]);
        $this->articlearea("jiujutsu",$article->jiujutsu,"none");
        $this->showhidebutton("mix",$titles["mix"]);
        $this->articlearea("mix",$article->mixure,"none");
        $this->makelink("/signup",$titles["signup"]);
    }
    
    public function studentview($pagenum){
        $amount_each_page=3;
        if($pagenum==null){
            $pagenum=1;
        }
        $students=student::get_students_chock($amount_each_page,$pagenum);
        foreach($students as $temp){
            echo "<tr>";
            echo "<td>";
            echo $temp->id;
            echo "</td><td>";
            echo $temp->name;
            echo "</td><td>";
            echo $temp->lisence;
            echo "</td><td>";
            echo $temp->status;
            echo "</td><td>";
            echo $temp->lessons_count;
            echo "</td>";
            echo "<td>";
            $link="/general_requests/dequalify/".$temp->id;
            echo "<a href='".$link."'>dequalify</a>";
            if($temp->status==0){
                echo "<br>";
                $link="/general_requests/accept/".$temp->id;
                echo "<a href='".$link."'>accept</a>";
            }
            echo "</td>";
            echo "</tr>";
        }
        $link="general_requests/pagedn";
        echo "<a href='".$link."'>prev</a>";
        $link="general_requests/pageup";
        echo "<br><a href='".$link."'>next</a>";
    }
}
