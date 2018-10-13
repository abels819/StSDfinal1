<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class manager extends Model
{
    public static function tokenin($id,$pwd){
        $manager= DB::table("manager")->where(["id"=>$id])->first();
        if($manager==null){
            return 0;
        }
        else{
            if($manager->pwd==md5($pwd)){
                return 1;
            }
            else{
                return 2;
            }
        }
    }
    
    public function pwdreset($id,$pwd){
        $pwd=md5($pwd);
        DB::table("manager")->where(["id"=>$id])->update(["pwd"=>$pwd]);
    }
    
    public function create_manager($pwd){
        DB::table("manager")->insert(["pwd"=>md5($pwd)]);
    }
    
    public static function add_tabin(){
        DB::table("tabinrecord")->insert(["time"=> date("y-m-d H:m:s")]);
    }
    
}
