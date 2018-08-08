@extends("pblades/rootblade")

@section("page_title")
@lang('content.checkin')
@stop

@section("main_content")
<form action="{{url('general_requests/checkin')}}" method="post">
    {{csrf_field()}}
    <div class='form'>
        <input type='text' class="input input-lg" size='25' name='name' id='name' placeholder="@lang('content.guestname')" />
        <a onclick="clearfield('name')"><i class="glyphicon glyphicon-remove"></i></a>
    </div>
    <div class='form'>
        <input type='text' class="input input-lg" size='25' name='idnum' id='idnum' placeholder="@lang('content.idnum')" />
        <a onclick="clearfield('idnum')"><i class="glyphicon glyphicon-remove"></i></a>
    </div>
    <div class='form'>
        <input type='submit'class='btn btn-lg btn-success' value='@lang("content.submit") ' style="width: 97%"/>
    </div>
</form>
@stop