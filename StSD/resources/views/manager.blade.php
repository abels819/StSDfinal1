@extends("pblades/rootblade")

@section("page_title")
@lang('content.manager')
@stop

@section("main_content")
<form action="{{url('general_requests/login')}}" method="post">
    {{csrf_field()}}
    <div class="form">
        <input type="text" name="id" class="input input-lg" size='25'placeholder="@lang('content.managerid')" id="id"/>
        <a onclick="clearfield('id')"><i class="glyphicon glyphicon-remove"></i></a>
    </div>
    <div class='form'>
        <input type='password' class="input input-lg" size='25' name='pwd' id="pwd" placeholder="@lang('content.pwd')" />
        <a onclick="clearfield('pwd')"><i class="glyphicon glyphicon-remove"></i></a>
    </div>
    <div class='form'>
        <input type='submit'class='btn btn-lg btn-success' value='@lang("content.submit") ' style="width: 97%"/>
    </div>
</form>
@stop