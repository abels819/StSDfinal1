@extends("pblades/rootblade")

@section("page_title")
@lang('content.welcomepage')
@stop

@section("main_content")
St international
<div class="form">
    <a href="{{url("signup")}}"  class="btn btn-warning btn-lg" style="width: 97%">@lang("content.signup")</a>
</div>
@stop