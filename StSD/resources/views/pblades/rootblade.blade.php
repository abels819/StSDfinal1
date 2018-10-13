<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <title>
            @section('page_title')
            @show
        </title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
        <script type="text/javascript" src='{{asset("js/jquery-3.2.1.js")}}'></script>
        <script type="text/javascript" src='{{asset("js/bootstrap.js")}}'></script>
        <script type="text/javascript" src='{{asset("js/page_js.js")}}'></script>
        <!--<script type="text/javascript" src='{{asset("js/scripts.js")}}'></script>!-->
        <link href='{{asset("css/bootstrap.css")}}' rel="stylesheet" />
        <link href='{{asset("css/bootstrap-theme.css")}}' rel="stylesheet" />
        <link href='{{asset("css/style.css")}}' rel="stylesheet" />
        
    </head>
    <body onload="bodyload()">
        <div class="header_bar">
            <div class="logo">
                <img src='{{asset("imgs/logo.jpg")}}' />
                <img src='{{asset("imgs/logo1.jpg")}}' />
                <img src='{{asset("imgs/logo3.jpg")}}' />
                <img src='{{asset("imgs/logo5.jpg")}}' />
                <img src='{{asset("imgs/logo6.jpg")}}' />
                <img src='{{asset("imgs/logo7.jpg")}}' />
                <img src='{{asset("imgs/logo8.jpg")}}' />
            </div>
        </div>
        <h1>
            <strong><i class="glyphicon glyphicon-chevron-right"></i><i class="glyphicon glyphicon-chevron-right"></i>@lang('content.title')<i class="glyphicon glyphicon-chevron-left"></i><i class="glyphicon glyphicon-chevron-left"></i></strong>
        </h1>
            <hr/>
        <h2>
            <strong><i class="glyphicon glyphicon-chevron-right"></i><i class="glyphicon glyphicon-chevron-right"></i>@lang('content.quote')<i class="glyphicon glyphicon-chevron-left"></i><i class="glyphicon glyphicon-chevron-left"></i></strong>
        </h2>
            
        <div class="nav-bar-container">
                <a href="{{url('/')}}" class="btn btn-lg">@lang('content.dashboard')</a>
                <a href="{{url("checkin")}}" class="btn btn-lg">@lang('content.checkin')</a>
                <a href="{{url("signup")}}" class="btn btn-lg">@lang('content.signup')</a>
                <a href="{{url("records")}}" class="btn btn-lg">@lang('content.remainclass')</a>
                <a href="{{url('manager')}}" class="btn btn-lg">@lang('content.manager')</a>
                <a href="{{url('general_requests/switchlang')}}/@lang('content.langtar')" class="btn btn-lg">@lang('content.switchlang')</a>
        </div>
        <div class="content-section">
            <div class="page-title" >
                <strong>{{$page_title}}</strong>
            </div>       
            <div id="main_content_section">
                @section('main_content').
                @show
            </div>
                
        </div>
        <footer>
                copyright 2018<br/>
                St international<br/>
        </footer>
        
        
    </body>
</html>

