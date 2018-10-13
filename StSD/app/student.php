<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class student extends Model
{
    var $id;
    var $status;
    var $lisence;
    var $name;
    public static function double_check($name,$lisence){
        return DB::table("student")->where(["name"=>$name,"lisence"=>$lisence,])->first();
    }
    
    public static function create_student($name,$lisence){
        DB::table("student")->insert(["name"=>$name,"lisence"=>$lisence]);
        return self::double_check($name, $lisence);
    }
    public static function check_arrivals($lisence){
        if(DB::table("arrivals")->where(["studentid"=>$lisence,"date"=>date("y-m-d")])->first()){
            return 1;
        }
        else return 0;
    }
    public static function arrivals($studentid){
        $student=DB::table("student")->where(["lisence"=>$studentid])->first();
        DB::table("student")->where(["lisence"=>$studentid])->update(["lessons_count"=>$student->lessons_count+1]);
        DB::table("arrivals")->insert(["date"=>date("y-m-d"),"studentid"=>$studentid]);
    }
    
    public static function article($lang){
        $article=DB::table("article")->where(["lang"=>$lang])->first();
        return $article;
    }
    
    public static function get_students_chock($amount_each_page,$pagenum){
        $students=DB::table("student")->skip(($pagenum-1)*$amount_each_page)->take($amount_each_page)->get();
        return $students;
    }
    
    public static function student_dequalify($id){
        DB::table("student")->where(["id"=>$id])->update(["status"=>2]);
    }
    public static function student_accept($id){
        DB::table("student")->where(["id"=>$id])->update(["status"=>1]);
    }
    
    public static function student_add($name,$id){
        DB::table("student")->insert(["name"=>$name,"lisence"=>$id]);
    }
}
