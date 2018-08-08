<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function switchlang($lang){
        session()->put('lang', $lang);
        return redirect()->route("homepage");
    }
    public static function get_lang(){
        $lang=session()->get('lang');
        if($lang==null){
            $lang='ch';
        }
        \App::setLocale($lang);
        return $lang;
    }
}
