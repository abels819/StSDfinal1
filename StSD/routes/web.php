<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\Controller;

Route::get('/', function () {
    $lang=Controller::get_lang();
    if($lang=="en"){
        $page_title="welcome page";
    }
    else{
        $page_title="首页";
    }
    
    return view('welcome')->with("page_title",$page_title);
})->name("homepage");

Route::get('checkin', function () {
    $lang=Controller::get_lang();
    if($lang=="en"){
        $page_title="check in";
    }
    else{
        $page_title="签到";
    }
    
    return view('checkin')->with("page_title",$page_title);
})->name("checkin");
Route::get('signup', function () {
    $lang=Controller::get_lang();
    if($lang=="en"){
        $page_title="sign up";
    }
    else{
        $page_title="报名";
    }
    
    return view('signup')->with("page_title",$page_title);
})->name("signup");

Route::get('records', function () {
    $lang=Controller::get_lang();
    if($lang=="en"){
        $page_title="records";
    }
    else{
        $page_title="报名记录";
    }
    
    return view('records')->with("page_title",$page_title);
})->name("records");

Route::get("lists/{id}",function($id){
    $lang=Controller::get_lang();
    if($lang=="en"){
        $page_title="records";
    }
    else{
        $page_title="报名记录";
    }
   $token=session()->get("data_access_token"); 
   if($token==md5("order_lists_access_granted")){
       session()->flash("id",$id);
       return view("records_list_view")->with("page_title",$page_title);
   }
   else {
       return redirect()->route("homepage");
   }
});

Route::group(["as"=>"general_requests::"],function(){
    Route::get("general_requests/switchlang/{lang}","Controller@switchlang");
    Route::post("general_requests/signup","general_requests@signup");
    Route::post("general_requests/checkin","general_requests@checkin");
    Route::post("general_requests/records","general_requests@records");
});
Route::group(["as"=>"ajax_requests::"],function(){
    Route::get("ajax_requests/periods","ajax_requests@periods");
    Route::get("ajax_requests/listview/{id}","ajax_requests@listview");
});