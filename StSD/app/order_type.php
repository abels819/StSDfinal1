<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class order_type extends Model
{
    var $id;
    var $period;
    var $name_en;
    var $name_ch;
    var $price;
    var $code;
    
    
    public static function aquire_all_order_types(){
        return DB::table("order_type")->get();
    }
    public static function aquire_one_type($code){
        return DB::table("order_type")->where(["code"=>$code])->first();
    }
}
