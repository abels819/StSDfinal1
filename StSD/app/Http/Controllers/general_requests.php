<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\student;
use App\order;
use App\order_type;
use App\manager;

class general_requests extends Controller
{
    var $end_of_term="2019_1_5";
    
    public function checkin(){
        $name=Input::post("name");
        $id=Input::post("idnum");
        $stat=0;
        $list=order::fetch_all_by_IDnumber($id);
        foreach ($list as $temp){
            if($temp->start_date==null||$temp->end_date==null){
                return "no available lessons found";
            }
            $statoforder=order::judge_duration($temp->start_date, $temp->end_date);
            //echo $temp->start_date."-----".$temp->end_date."-------".$statoforder."<br>";
            if($statoforder==0){
                order::change_of_stat($temp->id, 0);
            }
            else if($statoforder==1){
               $stat=1; 
               order::change_of_stat($temp->id, 1);
            }
            else if($statoforder==2){
               order::change_of_stat($temp->id, 2);
            }
            
        }
        if($stat==1){
            if(student::check_arrivals($id)==1){
                echo "checked today";
            }
            else{
                student::arrivals($id);
            }
        }
        else{
            echo "no available lessons found";
        }
        echo "</br><a href='/'>return</a>";
    }
    
    public function signup(){
        $name=input::post("name");
        $lisence=input::post("idnum");
        $period=input::post("period");
        $payment=input::post("payment");
        $year=input::post("year");
        $month=input::post("month");
        $day=input::post("day");
        if($name==null||$lisence==null||$period==null||$payment==null||$year==null||$month==null||$day==null){
            session()->put("errorinfo","请完整填写  please fill up all infos");
            return redirect()->back();
        }
        $stu=student::double_check($name, $lisence);
        if($stu==null){
            
            session()->put("errorinfo","请先加QQ或微信咨询注册  please make contact via QQ or Wechat first");
            return redirect()->back();
        }
        $order_type= order_type::aquire_one_type($period);
        $duration=$order_type->period;
        $startdate=$year."_".$month."_".$day;
        $enddate;
        if($duration=="D"){
            $enddate=$startdate;
        }
        else if($duration=="M"){
            if($month==12){
                $enddate=($year+1)."_"."1"."_".$day;
            }
            else{
                $enddate=$year."_".($month+1)."_".$day;
            }
        }
        else if($duration=="T"){
            $enddate= $this->end_of_term;
        }
        order::create_order($stu->id, $startdate, $enddate, $period,$payment);
        echo "purchase complete";
        echo "</br><a href='/'>return</a>";
    }
    public function records(){
        $idnum=input::post("idnum");
        $name=input::post("name");
        $student=student::double_check($name, $idnum);
        if($student!=null){
            session()->flash("data_access_token",md5("order_lists_access_granted"));
            return redirect("lists/".$student->id);
        }
        else{
            return redirect()->back();
        }
    }
    
    public function login(){
        $id=input::post("id");
        $pwd=input::post("pwd");
        
        $status=manager::tokenin($id,$pwd);
        if($status==1){
            return redirect("/studentlist");
        }
        else{
            return redirect()->back();
        }
    }
    
    public function accept($id){
        student::student_accept($id);
        return redirect("/studentlist");
    }
    
    public function dequalify($id){
        student::student_dequalify($id);
        return redirect("/studentlist");
    }
    
    public function pageup(){
        session()->put("pagenum",session()->get("pagenum")+1);
        return redirect("/studentlist");
    }
    public function pagedn(){
        if(session()->get("pagenum")>1){
            session()->put("pagenum",session()->get("pagenum")-1);
        }
        return redirect("/studentlist");
    }
    
    public function add_student(){
        $name=input::post("name");
        $id=input::post("idnum");
        student::student_add($name,$id);
        return redirect("/studentlist");
    }
}
