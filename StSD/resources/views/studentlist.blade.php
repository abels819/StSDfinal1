@extends("pblades/rootblade")

@section("page_title")
@lang('content.checkin')
@stop

@section("main_content")

<form action="/general_requests/add_student" method="post">
    {{csrf_field()}}
    <input type='text' class="input input-lg" size='25' name='name' id='name' placeholder="name" />
    <input type='text' class="input input-lg" size='25' name='idnum' id='idnum' placeholder="id" />
    <input type='submit'class='btn btn-lg btn-success' value='add'/>
</form>
<table class="table table-bordered table-hover table-responsive" id="listview">
    
</table>
<script>
    function construct_url(pagenum){
        return '{{url("ajax_requests/studentlist")}}'+'/'+pagenum;
    }
    function bodyload(){
        var pagenum={{session()->get("pagenum")}};
        var url=construct_url(pagenum);
        get_menu("listview",url);
    }
</script>
@stop