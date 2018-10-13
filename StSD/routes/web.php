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
use Illuminate\Support\Facades\Input;
use App\manager;


Route::get('/in',function(){
    manager::add_tabin();
    return redirect("/");
});

Route::get('/md5',function(){
    echo md5(input::get('param'));
});

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

Route::get('manager', function () {
    $lang=Controller::get_lang();
    if($lang=="en"){
        $page_title="manager options";
    }
    else{
        $page_title="管理者选项";
    }
    
    return view('manager')->with("page_title",$page_title);
})->name("manager");

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

Route::get('studentlist', function () {
    $lang=Controller::get_lang();
    if(session()->get("pagenum")==null){
        session()->put("pagenum",1);
    }
    if($lang=="en"){
        $page_title="student list";
    }
    else{
        $page_title="学生名单";
    }
    
    return view('studentlist')->with("page_title",$page_title);
})->name("studentlist");


Route::group(["as"=>"general_requests::"],function(){
    Route::get("general_requests/switchlang/{lang}","Controller@switchlang");
    //
    Route::get("general_requests/dequalify/{id}","general_requests@dequalify");
    Route::get("general_requests/accept/{id}","general_requests@accept");
    Route::get("general_requests/pagedn","general_requests@pagedn");
    Route::get("general_requests/pageup","general_requests@pageup");
    Route::post("general_requests/add_student","general_requests@add_student");
    //
    Route::post("general_requests/signup","general_requests@signup");
    Route::post("general_requests/checkin","general_requests@checkin");
    Route::post("general_requests/records","general_requests@records");
    Route::post("general_requests/login","general_requests@login");
});
Route::group(["as"=>"ajax_requests::"],function(){
    Route::get("ajax_requests/periods","ajax_requests@periods");
    Route::get("ajax_requests/listview/{id}","ajax_requests@listview");
    Route::get("ajax_requests/article","ajax_requests@article");
    Route::get("ajax_requests/studentlist/{pagenum}","ajax_requests@studentview");
});