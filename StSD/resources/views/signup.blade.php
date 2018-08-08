@extends("pblades/rootblade")

@section("page_title")
@lang('content.signup')
@stop

@section("main_content")
<form action="{{url('general_requests/signup')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" name="payment" id="payment" />
    <input type="hidden" name="period" id="period" />
    <div class='form'>
        <input type='text' class="input input-lg" size='25' name='name' id='name' placeholder="@lang('content.guestname')" />
        <a onclick="clearfield('name')"><i class="glyphicon glyphicon-remove"></i></a>
    </div>
    <div class='form'>
        <input type='text' class="input input-lg" size='25' name='idnum' id='idnum' placeholder="@lang('content.idnum')" />
        <a onclick="clearfield('idnum')"><i class="glyphicon glyphicon-remove"></i></a>
    </div>
    <div class="form">
        <h2 style="font-size: 15px">@lang("content.startdate")</h2>
    </div>
    <div class="form">
        <input type='text' class="input input-lg" size='3' name='year' id='year' placeholder="@lang('content.year')" />
        <input type='text' class="input input-lg" size='2' name='month' id='month' placeholder="@lang('content.month')" />
        <input type='text' class="input input-lg" size='2' name='day' id='day' placeholder="@lang('content.day')" />
    </div>
    <div class="form">
        <div class="dropdown">
            <a class="btn btn-lg btn-warning dropdown-toggle" data-toggle="dropdown" style="width: 97%" id="periodopt"><i class="glyphicon glyphicon-circle-arrow-down"></i>@lang("content.chooseperiod")</a>
            <ul class="dropdown-menu" id="periods">
            </ul>
        </div>
    </div>
    <div class="form">
        <div class="dropdown">
            <a class="btn btn-lg btn-warning dropdown-toggle" data-toggle="dropdown" style="width: 97%" id="payments"><i class="glyphicon glyphicon-circle-arrow-down"></i>@lang("content.pament")</a>
            <ul class="dropdown-menu" id="payments">
                <li><a onclick="apply('payment','payments','alipay')">@lang("content.alipay")</a></li>
                <li><a onclick="apply('payment','payments','wechat')">@lang("content.wechat")</a></li>
                <li><a onclick="apply('payment','payments','cash')">@lang("content.cash")</a></li>
            </ul>
        </div>
    </div>
    <div class='form'>
        <input type='submit'class='btn btn-lg btn-success' value='@lang("content.submit") ' style="width: 97%"/>
    </div>
</form>
<script>
    function bodyload(){
        get_menu("periods","ajax_requests/periods");
    }    
</script>
@stop